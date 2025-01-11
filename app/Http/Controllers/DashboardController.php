<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTrack;
use App\Models\UserRequests;
use App\Models\UserProgramme;
use App\Models\UserClearance;
use App\Models\TranscriptFee;
use App\Models\PaymentTransaction;
use App\Models\TranscriptUpload;
use App\Models\UserYear;
use App\Models\Registration;
use App\Models\Department;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\hod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    
    public function userMenu()
    {
        return view('layout.user-menu');
    }

    public function index()
    {
        try {
            $user_id = auth()->user()->id;
            // Query user's tracks for the authenticated user's email with pagination
            $user_track = UserTrack::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);
                
            // Query user request for the authenticated user's email with pagination
            $user_request = UserRequests::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            // Query user's tracks for the authenticated user's email with pagination
            $user_payment = PaymentTransaction::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            // Query user's transcript
            $user_transcript = TranscriptUpload::where('user_id', '=', $user_id)
                ->get();
            
            return view('dashboard.dashboard', compact('user_track', 'user_request', 'user_payment', 'user_transcript'));        
        } catch (Exception $e) {
            // Log the error
            Log::error('Error in index method: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard. Please try again.');
        }       
    }
    public function indexAdmin()
    {
        try {
            $user_id = auth()->user()->id;
            // Query all admin user
            $users = User::whereIn('user_type_status', [1, 2])->get();

            $instructors = User::whereIn('user_type_status', [3])->get();

            // Query successful payment transactions
            $successful_transactions = PaymentTransaction::where('transaction_status', 'Successful')->get();

            // Extract request IDs from successful transactions
            $successful_request_ids = $successful_transactions->pluck('request_id');

            // Query user requests using the request IDs 
            $user_requests = UserRequests::whereIn('request_id', $successful_request_ids)
                ->orderByRaw("CASE 
                                    WHEN certificate_status = 'In progress' THEN 1
                                    WHEN certificate_status = 'Processing' THEN 2
                                    WHEN certificate_status = 'Ready for pick-up' THEN 3
                                    ELSE 4
                                END")
                ->orderBy('created_at', 'desc')
                ->paginate(10);


            // Query user's transcript
            $user_transcript = TranscriptUpload::all();

            $students = Registration::all();
            $hod = hod::all();
            $departments = Department::all();
            $assignedCourse = Instructor::where('instructor_id', $user_id)->paginate(10);
        
            
            return view('dashboard.dashboard-admin', compact('users', 'user_requests','user_transcript',
            'instructors','students', 'hod', 'departments','assignedCourse'));        
        } catch (Exception $e) {
            // Log the error
            Log::error('Error in indexAdmin method: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while loading the admin dashboard. Please try again.');
        }       
    }

    public function userRequest()
    {
        try {
            $requestId = "#" .uniqid();
            $years = UserYear::all();
            $programmes = UserProgramme::orderBy('programme', 'asc')->get();

            return view('dashboard.user-request', ['requestId' => $requestId, 'years' => $years, 'programmes' => $programmes]);
        } catch (Exception $e) {
            // Log the error
            Log::error('Error in userRequest method: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }    

    public function userRequestAction(Request $request)
    {     
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'request_id' => 'required|string',
                'matric_no' => 'required|string',
                'programme' => 'required|string',
                'clearance_no' => 'required|string',
                'grad_year' => 'required|string',
                'phone_no' => 'required|string',
                'destination_address' => 'required|string',
                'certificate_name' => 'required|string',
            ]);

            // Check if the provided clearance_no exists in the UserClearance model
            $clearanceExists = UserClearance::where('clearance_no', $validatedData['clearance_no'])
                                ->where('user_name', $validatedData['matric_no'])
                                ->exists();

            // If the clearance_no doesn't exist, return back with an error message
            if (!$clearanceExists) {
                return redirect()->route('user-request')->with('error', 'The provided clearance number is invalid.');
                // return response()->json([
                //     'error' => 'The Clearance number is invalid.',
                // ]);
            }

            // Create UserRequests record
            $user = UserRequests::create([
                'user_id' => auth()->user()->id,
                'request_id' => $validatedData['request_id'],
                'email' => auth()->user()->email,
                'matric_no' => $validatedData['matric_no'],
                'programme' => $validatedData['programme'],   
                'clearance_no' => $validatedData['clearance_no'],
                'graduation_year' => $validatedData['grad_year'],
                'phone_no' => $validatedData['phone_no'], 
                'destination_address' => $validatedData['destination_address'],   
                'certificate_name' => $validatedData['certificate_name'],         
                'certificate_status' => "In progress",
            ]);  

            // Create UserTrack record
            $userTrack = UserTrack::create([
                'user_id' => auth()->user()->id,
                'request_id' => $validatedData['request_id'],
                'certificate_status' => "In progress",
                'approved_by' => auth()->user()->first_name,
                'comments' => "A transcript request has been started by you."
            ]);
            session(['request_id' => $validatedData['request_id'],
            'matric_no' => $validatedData['matric_no'],
            'full_name' => $validatedData['certificate_name'],
            'programme' => $validatedData['programme'],
            'phone_no' => $validatedData['phone_no'], 
            ]); 
                    

            // Redirect to user-payment route upon successful creation
            return redirect('user-payment');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during transcript request: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred during transcript request. Please try again.');
        }
    }

    public function userPayment()
    {   
        try {
            $yearkeep = date('Y');
            $monthkeep = date('m');
            $daykeep = date('d');
            $transactionId = "TF" . $yearkeep.$monthkeep.$daykeep . substr(uniqid(), 7, 5);
            
            $transcriptFees = TranscriptFee::all();        
            $requestId = session('request_id');
            $matricNo = session('matric_no');
            $fullName = session('full_name');
            $programme = session('programme');
            $phoneNo = session('phone_no');
            $product_desc = "Transcript Payment Fee";        
            
            //------PAYMENT INTEGRATION DETAILS--------------
            $merchant_id = "FLKOYSCHST001";
            $product_id = "FLKISWCP001";
            $product_description = $product_desc;
            foreach ($transcriptFees as $transcriptFee) {            
                $transcriptFee = $transcriptFee->fee_amount;   
                $amounttopay = $transcriptFee;        
                $payamount = ($transcriptFee + 350); //===added transaction fee
                $amount = ($transcriptFee + 350)* 100; //=====final value        
            }
            
            $transaction_id = $transactionId;
            session(['pay_amount' => ($amount/100)]);
            $currency = "566";
            $response_url = "http://127.0.0.1:8000/payment-check/";
            $notify_url = ""; 
            $name = trim($fullName) ;
            $email = auth()->user()->email;
            $customer_id = $matricNo;
            $phone_no = $phoneNo; 
            $secretKey = "c4502d31091fdd578dbdde27e09cc490942d4565c7b53323ced238d59aa3ae43";
            $payment_params = json_encode(['Transcript Payment Fee' => ['amount' => $amounttopay, 'code' => 'FLKACCOYLV001']
            ]);
        
            $string2hash = $merchant_id . $product_id . $product_description
            . $amount . $currency . $transaction_id . $customer_id . $name . $email . $phone_no
            . $payment_params . $response_url . $secretKey;
        
            $hashed_string = hash('sha256', $string2hash);
        
            //----create a transaction record----
            $paymentTransaction = PaymentTransaction::create([
                'user_id' => auth()->user()->id,
                'request_id' => $requestId,
                'matric_no' => $matricNo,
                'full_name' => $fullName,
                'phone_no' => $phoneNo,
                'programme' => $programme,
                'email' => auth()->user()->email,
                'amount' => $transcriptFee,
                'amount_due' => $transcriptFee + 350,
                'transaction_id' => $transactionId,
                'transaction_type' => "Transcript Payment",
                'transaction_status' => "Pending",
                'transaction_date' => date("Y-m-d H:i:s"),
                'response_code' => "",
                'response_status' => "",
                'flicks_transaction_id' => "",
                
            ]);
        
            return view('dashboard.user-payment', ['requestId' => $requestId, 
            'transcriptFee' => $transcriptFees, 'transactionId' => $transactionId,
            'merchant_id' => $merchant_id, 'product_id' => $product_id, 
            'product_description' => $product_description, 'amount' => $amount,
            'currency' => $currency, 'response_url' => $response_url,
            'matric_no' => $matricNo, 'phone_no' => $phone_no,
            'payment_params' => $payment_params, 'hashed_string' => $hashed_string, 'name' => $name,
            'pay_amount' => $payamount
            ]);
        } catch (Exception $e) {
            // Log the error
            Log::error('Error in transcript payment method: ' . $e->getMessage());
        
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while processing your transcript payment. Please try again.');
        }
        
        
    }  

    public function paymentCheck(Request $request) 

    {
        try {
            // Validate and retrieve transaction_id
            $rqr_transref = isset($_REQUEST['transaction_id']) ? $_REQUEST['transaction_id'] : null;
        
            // Check if 'pay_amount' session value is set
            $rqr_amount = session()->has('pay_amount') ? session('pay_amount') : null;
        
            if (!$rqr_transref || !$rqr_amount) {
                // Handle missing or invalid input
                // Redirect or return an error response as needed
                return redirect('payment-error')->with('error', 'Invalid transaction data');
            }
        
            // Initialize variables
            $merchant_id = "FLKOYSCHST001";
            $product_id = "FLKISWCP001";
            $requeryAmt = $rqr_amount * 100; // Ensure amount is in kobo
            $secretKey = "c4502d31091fdd578dbdde27e09cc490942d4565c7b53323ced238d59aa3ae43";
            $rqryTransaction_id = $rqr_transref;
            $requeryString2hash = $merchant_id . $product_id . $rqryTransaction_id . $secretKey;
            $requeryHashedValue = hash('sha256', $requeryString2hash);
            $setRequestHeaders = ["Hash: " . $requeryHashedValue];
        
            $requery = "https://flickspay.flickstechnologies.com/flk/collections/requery";
            $q = "/{$merchant_id}/{$product_id}/{$rqryTransaction_id}/{$requeryAmt}";
            $requeryURL = $requery . $q;
        
            // Make a check call to Interswitch
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $requeryURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $setRequestHeaders);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_POST, false);
            $data = curl_exec($ch);
        
            // Check for cURL errors
            if ($data === false) {
                // Handle cURL errors
                // Redirect or return an error response as needed
                return redirect('payment-error')->with('error', 'cURL request failed');
            }
        
            // Decode the JSON response
            $result = json_decode($data);
        
            // Check if decoding was successful
            if ($result === null) {
                // Handle JSON decoding errors
                // Redirect or return an error response as needed
                return redirect('payment-error')->with('error', 'Error decoding JSON response');
            }
        
            // Check if expected fields exist in the response
            if (!isset($result->ResponseCode) || !isset($result->ResponseDesc) || !isset($result->FLKTranxRef)) {
                // Handle missing fields in the response
                // Redirect or return an error response as needed
                return redirect('payment-error')->with('error', 'Missing fields in JSON response');
            }
        
            // Extract response data
            $ResponseCode = $result->ResponseCode;
            $ResponseDesc = $result->ResponseDesc;
            $flicks_transref = $result->FLKTranxRef;
        
            // Store response data in session
            session([
                'flicks_transref' => $flicks_transref,
                'response_code' => $ResponseCode,
                'response_desc' => $ResponseDesc,
                'pay_amount' => $rqr_amount,
                'transaction_id' => $rqr_transref,
            ]);
        
            // Check response code and redirect accordingly
            if ($ResponseCode !== "00") {
                // Failed Transaction
                PaymentTransaction::where('transaction_id', $rqr_transref)->update([
                    'response_code' => $ResponseCode,
                    'response_status' => $ResponseDesc,
                    'transaction_status' => 'Failed', 
                    'flicks_transaction_id' => $flicks_transref,
                ]);
               
                return redirect()->route('send-mail-fail', ['transaction_id' => $rqr_transref]);
            } else {
                // Successful Transaction
                PaymentTransaction::where('transaction_id', $rqr_transref)->update([
                    'response_code' => $ResponseCode,
                    'response_status' => $ResponseDesc,
                    'transaction_status' => 'Successful', 
                    'flicks_transaction_id' => $flicks_transref,
                ]);
                
                return redirect()->route('send-mail-success', ['transaction_id' => $rqr_transref]);
            }
        } catch (Exception $e) {
            // Log the error
            Log::error('Error in payment requery method: ' . $e->getMessage());
        
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while processing payment requery. Please try again.');
        }
        
    }

    public function paymentError()
    {
        try {
            $flicks_transref = session('flicks_transref');
            $ResponseCode = session('response_code');
            $ResponseDesc = session('response_desc');
            $payAmount = session('pay_amount');
            $transactionID = session('transaction_id');
        
            return view('dashboard.payment-error', [
                'transactionID' => $transactionID,
                'flicks_transref' => $flicks_transref,
                'ResponseCode' => $ResponseCode,
                'ResponseDesc' => $ResponseDesc,
                'PayAmount' => $payAmount
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function paymentReport()
    {   
        try {
            $user_id = auth()->user()->id;
            $paymentTransaction = PaymentTransaction::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            
            return view('dashboard.payment-report', compact('paymentTransaction'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function paymentStatus()
    {
        try {
            $flicks_transref = session('flicks_transref');
            $ResponseCode = session('response_code');
            $ResponseDesc = session('response_desc');
            $payAmount = session('pay_amount');
            $totalAmountDue = session('pay_amount') + 350;
            $transactionID = session('transaction_id');
        
            if ($ResponseCode === "00") {
                $transactionMessage = "Your transaction was successful, payment details has been sent to your email.";
            } else {
                $transactionMessage = "Your transaction was not successful, payment details has been sent to your email.";
            }
        
            return view('dashboard.payment-status-page', ['transactionID' => $transactionID, 'flicks_transref' => $flicks_transref,
                'ResponseCode' => $ResponseCode, 'ResponseDesc' => $ResponseDesc, 'amount' => $payAmount,
                'transaction_message' => $transactionMessage, 'amount_due' => $totalAmountDue]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function contactUs()
    {
        return view('dashboard.contact-us');
    }

    public function transcriptRequest()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->transcript;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }

            $user_id = auth()->user()->id;
            // Query all admin user
            $users = User::whereIn('user_type_status', [1, 2])->get();
            
            // Query successful payment transactions
            $successful_transactions = PaymentTransaction::where('transaction_status', 'Successful')->get();
        
            // Extract request IDs from successful transactions
            $successful_request_ids = $successful_transactions->pluck('request_id');
        
            $user_requests = UserRequests::whereIn('request_id', $successful_request_ids)
                ->orderByRaw("CASE 
                                    WHEN certificate_status = 'In progress' THEN 1
                                    WHEN certificate_status = 'Processing' THEN 2
                                    WHEN certificate_status = 'Ready for pick-up' THEN 3
                                    ELSE 4
                                END")
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        
            // Query user's transcript
            $user_transcript = TranscriptUpload::all();
        
            return view('dashboard.transcript-request', compact('users', 'user_requests', 'user_transcript'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
                
    }    
    
    public function transcriptRequestView(Request $request, string $id)
    {
        try {
            // Retrieve the UserRequest record by ID
            $user_request = UserRequests::findOrFail($id);        
            // Extract the request_id from the retrieved UserRequest record
            $request_id = $user_request->request_id;
            
            // Retrieve payment transaction details using the request_id
            $payment_transaction_details = PaymentTransaction::where('request_id', $request_id)->get();
        
            // Query user's tracks for the authenticated user's email with pagination
            $user_track = UserTrack::where('request_id', '=', $request_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        
            return view('dashboard.transcript-request-view', compact('payment_transaction_details', 
            'user_requests', 'user_track'));  
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }
    
    public function transcriptRequestAction(Request $request, string $id)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'comment' => 'required|string',
                'transcript_status' => 'required|string',
            ]);
        
            $user_request = UserRequests::findOrFail($id);                
            $request_id = $user_request->request_id;
            $user_id = $user_request->user_id;
        
            // Check if an upload has been made for the request_id
            $transcriptUpload = TranscriptUpload::where('request_id', $request_id)->first();
        
            if ($transcriptUpload) {
                // If an upload has already been done, redirect back with a message
                return redirect()->back()->with('error', 'Transcript has already been uploaded for this request.');
            }
            
            // Create UserTrack record
            $userTrack = UserTrack::create([
                'user_id' => $user_id,
                'request_id' => $request_id,
                'certificate_status' => $validatedData['transcript_status'],
                'approved_by' => "admin",
                'comments' => $validatedData['comment'],
            ]);
        
            //--Update user request data-----
            UserRequests::where('id', $id)->update([
                'certificate_status' => $validatedData['transcript_status'],            
            ]);
        
            return redirect()->route('admin-dashboard')->with('success', 'Transcript request update successful.');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function Users()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->admins;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }
        
            $users = User::whereIn('user_type_status', [1, 2])->paginate(10);
            $allUsers = User::whereIn('user_type_status', [1, 2])->get();
            
            return view('auth.users', compact('users','allUsers'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

    public function addUser()
    {   
        $allDepartment = Department::all(); 
        return view('auth.add-user', compact('allDepartment'));
    }

    public function addUserAction(Request $request)
    {
        try {
            // Validate the input data
            $validatedData = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'userType' => 'required|string',
                'user_status' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'department' => 'nullable|string'
            ]);

            $email_token = Str::random(40);

            // Prepare role data based on the checkboxes
            $roles = [
                'class_list' => $request->has('classList') ? 1 : 0,
                'course_setup' => $request->has('courseSetup') ? 1 : 0,
                'score_sheet' => $request->has('scoreSheet') ? 1 : 0,
                'grading_system' => $request->has('gradingSystem') ? 1 : 0,
                'access_setup' => $request->has('accessSetup') ? 1 : 0,
                'admins' => $request->has('admins') ? 1 : 0,
                'instructors' => $request->has('instructors') ? 1 : 0,
                'students' => $request->has('students') ? 1 : 0,
                'hod_setup' => $request->has('hodSetup') ? 1 : 0,
                'result' => $request->has('result') ? 1 : 0,
                'student' => $request->has('student') ? 1 : 0,
                'result_entry' => $request->has('resultEntry') ? 1 : 0,
                'student_registration' => $request->has('studentRegistration') ? 1 : 0,
                'result_compute' => $request->has('resultCompute') ? 1 : 0,
                'student_migration' => $request->has('studentMigration') ? 1 : 0,
                'semester_result' => $request->has('semesterResult') ? 1 : 0,
                'semester_summary' => $request->has('semesterSummary') ? 1 : 0,
                'cgpa_summary' => $request->has('cgpaSummary') ? 1 : 0,
                'student_transcript' => $request->has('studentTranscript') ? 1 : 0,
                'transcript' => $request->has('transcript') ? 1 : 0,
            ];

            if($validatedData['userType'] == 'Superadmin') {
                $userTypeStatus = 1;
            }
            elseif($validatedData['userType'] == 'Admin') {
                $userTypeStatus = 2;
            }
            elseif($validatedData['userType'] == 'Instructor') {
                $userTypeStatus = 3;
            }
            elseif($validatedData['userType'] == 'Student') {
                $userTypeStatus = 4;
            }
            
            if ($request->hasFile('image')) {
                // Generate a unique file name
            $imageFile = $request->file('image');
            $generatedFileName = uniqid() . '.' . $imageFile->getClientOriginalExtension();

            // Save the file to the public/signature directory
            $imageFile->move(public_path('profile_pictures'), $generatedFileName);
            }
            else{
                $generatedFileName = "blank.jpg";
            }
            
            // Merge validated data with roles
            $userData = array_merge($validatedData, $roles, [
                'password' => Hash::make($validatedData['password']),
                'email_verified_status' => 1,
                'login_attempts' => 0,
                'remember_token' => $email_token,
                'user_type' => $validatedData['userType'],
                'user_status' => $validatedData['user_status'],
                'user_type_status' => $userTypeStatus,
                'image' => $generatedFileName,
                'department' => $validatedData['department'],
            ]);
            
            // Create the user with roles
            $user = User::create($userData);
            if($validatedData['userType'] == 'Superadmin'){
                return redirect()->route('users')->with('success', 'Admin has been created successfully.');
            }
            elseif($validatedData['userType'] == 'Admin'){
                return redirect()->route('users')->with('success', 'Admin has been created successfully.');
            }
            elseif($validatedData['userType'] == 'Instructor'){
                return redirect()->route('instructors')->with('success', 'Instructor has been created successfully.');
            }            
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during user registration: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    public function editUser($id)
    {
        $user = User::findorFail($id);
        $allDepartment = Department::all(); 

        return view('auth.edit-user',compact('user', 'allDepartment'));
    }

    public function editStudent($id)
    {
        $user = Registration::findorFail($id);
        $programmes = CourseStudyAll::all();

        return view('layout.edit-student-layout',compact('user','programmes'));
    }

    public function editUserAction(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'last_name' => 'required|string|max:255',
        //     'first_name' => 'required|string|max:255',
        //     'user_status' => 'required|string',
        //     'email' => 'required|email|unique:users,email,' . $id, 
        //     'password' => 'nullable|string|min:8|confirmed', 
        //     'userType' => 'required|string',                 
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'department' => 'nullable|string'
        // ]);

        // return response()->json($validatedData);
        try {
            // Validate the input data
            $validatedData = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'user_status' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id, 
                'password' => 'nullable|string|min:8|confirmed', 
                'userType' => 'required|string',                 
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'department' => 'nullable|string'
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // If the password is provided, hash it before updating
            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                // If password is not provided, retain the current password
                unset($validatedData['password']);
            }

            // Prepare role data based on the checkboxes
            $roles = [
                'class_list' => $request->has('classList') ? 1 : 0,
                'course_setup' => $request->has('courseSetup') ? 1 : 0,
                'score_sheet' => $request->has('scoreSheet') ? 1 : 0,
                'grading_system' => $request->has('gradingSystem') ? 1 : 0,
                'access_setup' => $request->has('accessSetup') ? 1 : 0,
                'admins' => $request->has('admins') ? 1 : 0,
                'instructors' => $request->has('instructors') ? 1 : 0,
                'students' => $request->has('students') ? 1 : 0,
                'hod_setup' => $request->has('hodSetup') ? 1 : 0,
                'result' => $request->has('result') ? 1 : 0,
                'student' => $request->has('student') ? 1 : 0,
                'result_entry' => $request->has('resultEntry') ? 1 : 0,
                'student_registration' => $request->has('studentRegistration') ? 1 : 0,
                'result_compute' => $request->has('resultCompute') ? 1 : 0,
                'student_migration' => $request->has('studentMigration') ? 1 : 0,
                'semester_result' => $request->has('semesterResult') ? 1 : 0,
                'semester_summary' => $request->has('semesterSummary') ? 1 : 0,
                'cgpa_summary' => $request->has('cgpaSummary') ? 1 : 0,
                'student_transcript' => $request->has('studentTranscript') ? 1 : 0,
                'transcript' => $request->has('transcript') ? 1 : 0,
            ];

                // Handle image file if uploaded
            if ($request->hasFile('image')) {
                // Delete the old simage file if it exists
                $oldImagePath = public_path('profile_pictures/' . $user->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                } 
                // Save the new image file
                $imageFile = $request->file('image');
                $generatedFileName = uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('profile_pictures'), $generatedFileName);

                // Update the image field in the database
                $userImage = ['image' => $generatedFileName] ;
            }
            else{
                $userImage = ['image' => $user->image] ;
            }

            if ($validatedData['userType'] == 'Superadmin') {
                $userType = ['user_type' => 'Superadmin'];
                $userTypeStatus = ['user_type_status' => 1];
                $department = "";                
            } elseif ($validatedData['userType'] == 'Admin') {
                $userType = ['user_type' => 'Admin'];
                $userTypeStatus = ['user_type_status' => 2];   
                $department = "";             
            } elseif ($validatedData['userType'] == 'Instructor') {
                $userType = ['user_type' => 'Instructor'];
                $userTypeStatus = ['user_type_status' => 3];
                $department = ['department' => $validatedData['department']];
            } elseif ($validatedData['userType'] == 'Student') {
                $userType = ['user_type' => 'Student'];
                $userTypeStatus = ['user_type_status' => 4];
                $department = ""; 
            }

            // Merge roles and user type status with the validated data
            $userData = array_merge($validatedData, $roles, $userTypeStatus,$userType,$userImage);

            // Update the user with new data (including roles)
            $user->update($userData);

            if($validatedData['userType'] == 'Superadmin'){
                return redirect()->route('users')->with('success', 'Admin has been updated successfully.');
            }
            elseif($validatedData['userType'] == 'Admin'){
                return redirect()->route('users')->with('success', 'Admin has been updated successfully.');
            }
            elseif($validatedData['userType'] == 'Instructor'){
                return redirect()->route('instructors')->with('success', 'Instructor has been updated successfully.');
            }           
            
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            Log::error('Error during user update: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during user update: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during the update. Please try again.');
        }
    }

    public function editStudentAction(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'studentFullName' => 'required|string|max:255',
            'programme' => 'required|string',
        ]);

        try {
            // Find the registration record by ID
            $registration = Registration::findOrFail($id);

            // Update the record with new data
            $registration->update([
                'student_full_name' => $request->input('studentFullName'),
                'course' => $request->input('programme'),
            ]);

            // Redirect back with success message
            return redirect()->route('student')->with('success', 'Student details updated successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Error updating student details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the student details. Please try again.');
        }
    }

    public function transcriptUpload(Request $request, string $id)
    {
        try {
            $user_requests = UserRequests::where('id', '=', $id)->get();
            
            // Retrieve the UserRequest record by ID
            $user_request = UserRequests::findOrFail($id);
            
            // Extract the request_id from the retrieved UserRequest record
            $request_id = $user_request->request_id;
            
            // Retrieve payment transaction details using the request_id
            $payment_transaction_details = PaymentTransaction::where('request_id', $request_id)->get();
            
            // Query user's tracks for the authenticated user's email with pagination
            $user_track = UserTrack::where('request_id', '=', $request_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        
            return view('dashboard.transcript-upload', compact('payment_transaction_details', 'user_requests', 'user_track'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function transcriptUploadAction(Request $request, string $id) 
    {
        try {
            $validatedData = $request->validate([
                'comment' => 'required|string',
                'transcript_status' => 'required|string',
                'transcript_file' => 'nullable|mimes:pdf',
            ]);       

            $user_request = UserRequests::findOrFail($id);                
            $request_id = $user_request->request_id;
            $user_id = $user_request->user_id;
            $email = $user_request->email;

            // Check if an upload has been made for the request_id
            $transcriptUpload = TranscriptUpload::where('request_id', $request_id)->first();

            if ($transcriptUpload) {
                // If an upload has already been done, redirect back with a message
                return redirect()->back()->with('error', 'Transcript has already been uploaded for this request.');
            }

            // Proceed with file upload only if a file has been uploaded
            if ($request->hasFile('transcript_file')) {
                $userCertificateFile = $request->file('transcript_file');
                $request_id_new = str_replace('#', '', $request_id);
                // Generate filenames                 
                $userCertificateFilename = $request_id_new . '_transcript.' . $userCertificateFile->getClientOriginalExtension();
                // Store file
                $certificatePath = $userCertificateFile->storeAs('transcript', $userCertificateFilename, 'public');
            }

            // Create UserTranscript record
            $userTranscript = TranscriptUpload::create([
                'user_id' => $user_id,
                'request_id' => $request_id,
                'email' => $email,
                'upload_by' => "admin",
                'status' => "successful",
                'transcript_dir' => $certificatePath ?? null, 
            ]);

            // Create UserTrack record
            $userTrack = UserTrack::create([
                'user_id' => $user_id,
                'request_id' => $request_id,
                'certificate_status' => $validatedData['transcript_status'],
                'approved_by' => "admin",
                'comments' => $validatedData['comment'],
            ]);

            //--Update user request data-----
            UserRequests::where('id', $id)->update([
                'certificate_status' => $validatedData['transcript_status'],            
            ]); 

            return redirect()->route('admin-dashboard')->with('success', 'User transcript upload successful.');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            $errorMessage = 'Error-User transcript upload: ' . $e->getMessage();
            Log::error($errorMessage);

            return redirect()->back()->with('error', 'An error occurred during User transcript upload. Please try again.');
        }
    }

    public function userTranscriptUpload()
    {
        try {
            $user_id = auth()->user()->id;
            
            // Query all admin users
            $users = User::where('user_type', '=', 'admin')->get();
            
            // Query successful payment transactions
            $successful_transactions = PaymentTransaction::where('transaction_status', 'Successful')->get();
        
            // Extract request IDs from successful transactions
            $successful_request_ids = $successful_transactions->pluck('request_id');
        
            // Query successful transcript uploads
            $transcript_uploads = TranscriptUpload::where('status', 'Successful')->get();
        
            // Extract request IDs from successful transcript uploads
            $successful_request_ids = $transcript_uploads->pluck('request_id');
        
            // Query user requests based on successful request IDs
            $user_requests = UserRequests::whereIn('request_id', $successful_request_ids)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        
            // Add date of upload to each user request
            foreach ($user_requests as $user_request) {
                $transcript_upload = TranscriptUpload::where('request_id', $user_request->request_id)->first();
                $user_request->date_of_upload = $transcript_upload ? $transcript_upload->created_at : null;
            }
        
            // Query user's transcript uploads
            $user_transcript = TranscriptUpload::all();
        
            // Pass variables to the view
            return view('dashboard.user-transcript-upload', compact('users', 'user_requests', 'user_transcript', 'transcript_uploads'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
        
    }

    public function classList()
    {
        $user = auth()->user();
        $rolePermission = $user->class_list;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        $allLevel = StudentLevel::all();
        $programmes = CourseStudyAll::all();

        return view('layout.class-list', compact('allLevel','programmes'));
    }

    public function classListAction(Request $request)
    {
        try {
            // Get the query parameters (fallback to default if not present)
            $programme = $request->query('programme', '');
            $admissionYear = $request->query('admissionYear', '');
            $stdLevel = $request->query('stdLevel', '');

            // Validate the inputs
            if (empty($programme) || empty($admissionYear) || empty($stdLevel)) {
                return redirect()->back()->with('error', 'All filters are required.');
            }

            // Fetch paginated results
            $students = Registration::where('admission_year', $admissionYear)
                ->where('course', $programme)
                ->where('class', $stdLevel)
                ->orderBy('admission_no', 'asc')
                ->get();
                // ->appends($request->query()); 

            $allStudent = Registration::where('admission_year', $admissionYear)
            ->where('course', $programme)
            ->where('class', $stdLevel)
            ->orderBy('admission_no', 'asc')
            ->get();

            if ($students->isEmpty()) {
                return redirect()->back()->with('error', 'No students found for the selected filters.');
            }

            return view('layout.class-list-view', [
                'students' => $students,
                'studentLevel' => $stdLevel,
                'programme' => $programme,
                'admissionYear' => $admissionYear,
                'allStudent' => $allStudent,
            ]);
        } catch (\Exception $e) {
            Log::error('Unexpected Error: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }    

    public function pageDevelopment()
    {
        return view('layout.page-development');
    }

    public function testFile()
    {
        return view('layout.test-file');
        
    }
   

}
