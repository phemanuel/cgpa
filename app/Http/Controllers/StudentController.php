<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use App\Models\StudentLevel;
use App\Models\CourseStudy;
use App\Models\CourseStudyAll;
use App\Models\UserTrack;
use App\Models\UserRequests;
use App\Models\UserProgramme;
use App\Models\UserClearance;
use App\Models\TranscriptFee;
use App\Models\PaymentTransaction;
use App\Models\TranscriptUpload;
use App\Models\ResultCompute;
use App\Models\hod;
use App\Models\GradingSystem;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
        try {
            // Get the currently authenticated student
            $student = auth('student')->user();

            // Example: get their ID or matricNo
            $student_id = $student->id; 
            $matric_no  = $student->matricNo;

            // Use $student_id or $matric_no as needed in your queries
            $user_track = UserTrack::where('user_id', $student_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            $user_request = UserRequests::where('user_id', $student_id)
                ->orderBy('created_at', 'desc')
                ->paginate(3);

            $user_payment = PaymentTransaction::where('user_id', $student_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            $user_transcript = TranscriptUpload::where('user_id', $student_id)
                ->get();
            
            return view('dashboard.dashboard', compact(
                'user_track',
                'user_request',
                'user_payment',
                'user_transcript'
            ));        

        } catch (Exception $e) {
            Log::error('Error in index method: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while loading the dashboard. Please try again.');
        }       
    }

    public function students()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->students;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }
        
            $users = Registration::paginate(10); 
            $userCount = Registration::count();
            return view('layout.students', compact('users','userCount'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

    public function studentRegistration()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->students;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }
        
            $users = Registration::paginate(10);
            $userCount = Registration::count();
            $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
            $allLevel = StudentLevel::all();
            //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'Student List viewed by ' . auth()->user()->last_name . ' '. auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }
            return view('layout.students-page', compact('users','userCount', 'programmes', 'allLevel'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }

        // return redirect()->route('page-development');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'admission_no' => 'required|string|max:255',
            'reg_no' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'other_name' => 'nullable|string|max:255',
            'class' => 'required|string',
            'gender' => 'required|string|max:6',
            'programme' => 'required|string|max:255',
            'admission_year' => 'required|integer',
            'phone_no' => 'nullable|numeric',
            'state' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'picture_dir' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If validation fails, return back with validation error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the admission number already exists in the registration table
        if (Registration::where('admission_no', $request->admission_no)->exists()) {
            return redirect()->back()->with('error', 'Admission number already exists in the registration table.');
        }

        // Handle file upload if there is a profile picture
        if ($request->hasFile('picture_dir')) {
            $file = $request->file('picture_dir');
            $originalFileName = time();
            $filename = $originalFileName . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        } else {
            $filename = null;
        }

        // Store the student data in the database
        $student = Registration::create([
            'admission_no' => $request->admission_no,
            'reg_no' => $request->reg_no,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'gender' => $request->gender,
            'course' => $request->programme,
            'class' => $request->class,
            'admission_year' => $request->admission_year,
            'result_year' => $request->admission_year,
            'phone_no' => $request->phone_no,
            'state' => $request->state,
            'lga' => $request->lga,
            'dob' => $request->dob,
            'address' => $request->address,
            'picture_dir' => $originalFileName,
            'ident_status' => 'STUDENT',
            'student_full_name' => $request->surname . " " . $request->first_name . " " . $request->other_name,
            'acad_session' => $request->admission_year . "/" . ($request->admission_year + 1),
            'migrate_status' => 0,
        ]);
        //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'New student created by ' . auth()->user()->last_name . ' '. auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }

        return redirect()->route('student-registration')->with('success', 'Student data saved successfuly.');
        // return response()->json(['success' => true]);
    }

    public function import(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $file = $request->file('import_file');
            $fileName = $file->getRealPath();            
            $session1 =  $request->get('session1');

            if (($handle = fopen($fileName, "r")) !== FALSE) {
                $headers = fgetcsv($handle, 10000, ","); // Read headers
                while (($column = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    $data = array_combine($headers, $column); // Combine headers with data

                    // Insert data into database
                    DB::table('registrations')->insert([
                        'admission_no' => $data['admission_no'], 
                        'admission_year' => $data['admission_year'],                   
                        'surname' => $data['surname'],
                        'first_name' => $data['first_name'],
                        'other_name' => $data['other_name'],
                        'course' => $data['course'],
                        'class' => $data['class'],
                        'gender' => $data['gender'],
                        'state' => $data['state'],
                        'lga' => $data['lga'],                        
                        'phone_no' => $data['phone_no'],
                        //-------Others--------------
                        'reg_no' => $data['admission_no'],
                        'result_year' => $data['admission_year'],
                        'ident_status' => "STUDENT",
                        'picture_dir' => "blank",
                        'student_full_name' => $data['surname'] . " " . $data['first_name'] . " " . $data['other_name'],
                        'acad_session' => $data['admission_year'] . "/" . ($data['admission_year'] + 1),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                fclose($handle);
                // $type = "success";
                // $message = "CSV Data Imported into the Database";
                // Redirect back with success message
                //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'New students imported by ' . auth()->user()->last_name . ' '. auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }
            return redirect()->route('student-registration')->with('success', 'Student Data imported successfully.');
            } else {
                // Log or handle missing data
            Log::warning('Missing data in row: ' . json_encode($row));
            return redirect()->back()->with('error', 'Student data import not successful.');
            }  
        } else {
           
           return redirect()->back()->with('error', 'No file was uploaded.');
        }  
    }

    public function searchStudents(Request $request)
    {
        $search = $request->input('query');

        $users = Registration::where('admission_no', 'like', "%$search%")
            ->orWhere('student_full_name', 'like', "%$search%")
            ->paginate(10);

        if ($request->ajax()) {
            $view = view('partials.student_rows', compact('users'))->render();
            $pagination = $users->links()->render();

            return response()->json([
                'rows' => $view,
                'pagination' => $pagination
            ]);
        }

        return view('your-main-view', compact('users'));
    }


    public function studentMigration()
    {
        return redirect()->route('page-development');        
    }

    public function studentMenu()
    {
        return view('layout.student-menu');
    }

    public function studentResult()
    {
       
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();        
        $allLevel = StudentLevel::all();

        return view('layout.student-result', compact('programmes', 'allLevel'));
    }

    public function studentResultPreview(Request $request)
    { 
        // Validate the incoming request data
        $validatedData = $request->validate([
            'stdLevel'     => 'required|string',
            'semester'     => 'required|string',
            'acad_session' => 'required|string',
            'programme'    => 'required|string',
        ]);

        // Retrieve validated input
        $level       = $validatedData['stdLevel'];
        $semester    = ucfirst(strtolower($validatedData['semester'])); 
        $acadSession = $validatedData['acad_session'];
        $programme   = $validatedData['programme'];

        $student = Auth::guard('student')->user();
        $admissionNo = $student->admission_no;

            // Query single student's result
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->where('admission_no', $admissionNo)
                ->first();
        if (!$results) {
                // \Log::info("No results found for student {$admissionNo} ({$acadSession} {$programme} {$level} {$semester})");
                return redirect()->back()->with('error', 'Result unavailable.');
            }

        $courseStudy = CourseStudy::where('dept_name', $validatedData['programme'])->first();
        $courseDuration = $courseStudy->dept_duration;

        if($courseDuration == 2){
            // Define the mapping of level and semester combinations to methods
            $methodMap = [
                '100'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                '200'  => ['First' => 'preview100First',  'Second' => 'preview300Second'],                
                'NDI'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                'NDII' => ['First' => 'preview100First',  'Second' => 'preview300Second'],
				'HNDI'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                'HNDII' => ['First' => 'preview100First',  'Second' => 'preview300Second'],
            ];
        }
        elseif($courseDuration == 3){
                // Define the mapping of level and semester combinations to methods
                $methodMap = [
                    '100'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                    '200'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                    '300'  => ['First' => 'preview100First',  'Second' => 'preview300Second'],                    
                ];
        }

        // Check if the provided level and semester have a corresponding method
        if (isset($methodMap[$level][$semester])) {
            $method = $methodMap[$level][$semester];
            return $this->$method($acadSession, $programme, $level, $semester, $request);
        }        

        // Handle other cases or return a default response
        return redirect()->back()->with('error', 'Invalid selection made.');     

        
    }

    public function preview100First($acadSession, $programme, $level, $semester, Request $request)
    {
        try {
            $student = Auth::guard('student')->user();
            $admissionNo = $student->admission_no;

            // Query single student's result
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->where('admission_no', $admissionNo)
                ->first();

            // Handle no result found
            if (!$results) {
                \Log::info("No results found for student {$admissionNo} ({$acadSession} {$programme} {$level} {$semester})");
                return redirect()->route('student-result-preview')->with('error', 'No results found.');
            }

            // Format data for the view
            $studentData = [
                'stusurname'       => $results->student_full_name ?? 'No Name',
                'stuno'            => $results->admission_no ?? 'No Matric No',
                'class'            => $results->class ?? 'No Level',
                'coursekeep'       => $results->course ?? 'No Programme',
                'studpicture'      => $results->picture_dir ?? 'No Picture',
                'totalGradePoints' => $results->total_grade_point ?? 0,
                'totalUnits'       => $results->total_course_unit ?? 0,
                'totalGPA'         => $results->gpa ?? 0.0,
                'letterGrade'      => $results->subjectgrade1 ?? 'No Grade',
                'remarks'          => $results->remark ?? 'No Remarks',
                'failedRemarks'    => $results->failed_course ?? 'No failed course',
                'ctitles'          => array_map(fn($i) => $results->{"ctitle{$i}"} ?? null, range(1, 17)),
                'subjects'         => array_map(fn($i) => $results->{"subject{$i}"} ?? null, range(1, 16)),
                'subjectGrades'    => array_map(fn($i) => $results->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                'units'            => array_map(fn($i) => $results->{"unit{$i}"} ?? null, range(1, 18)),
                'scores'           => array_map(fn($i) => $results->{"score{$i}"} ?? null, range(1, 19)),
            ];

            // Fetch HOD info and grading system
            $hod = Hod::where('course', $programme)->first();
            $grading = GradingSystem::first();

            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Log student activity
            if (Auth::guard('student')->check()) {
                \App\Models\LogActivity::create([
                    'user_id'      => $student->id ?? null,
                    'ip_address'   => $request->ip(),
                    'activity'     => "Viewed student result for {$acadSession} {$programme} {$level} {$semester} ({$admissionNo})",
                    'activity_date'=> now(),
                ]);
            }

            // Return view
            return view('results.student_result_page_1', [
                'results'     => $results,
                'studentData' => $studentData,
                'semester'    => $semester,
                'grades'      => $grades,
                'hod'         => $hod,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in preview100First: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function preview100Second($acadSession, $programme, $level, $semester, Request $request)
    {
        try {
            $student = Auth::guard('student')->user();
            $admissionNo = $student->admission_no;

            // Query single student's result
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->where('admission_no', $admissionNo)
                ->first();

            // Handle no result found
            if (!$results) {
                \Log::info("No results found for student {$admissionNo} ({$acadSession} {$programme} {$level} {$semester})");
                return redirect()->route('student-result-preview')->with('error', 'No results found.');
            }

            // Format data for the view
            $studentData = [
                    'stusurname' => $results->student_full_name ?? 'No Name',
                    'stuno' => $results->admission_no ?? 'No Matric No',
                    'class' => $results->class ?? 'No Level',
                    'coursekeep' => $results->course ?? 'No Programme',
                    'studpicture' => $results->picture_dir ?? 'No Picture',
                    'totalGradePoints' => $results->total_grade_point ?? 0,
                    'totalUnits' => $results->total_course_unit ?? 0,
                    'totalGPA' => $results->gpa1 ?? 0.0,
                    'totalGPA2' => $results->gpa2 ?? 0.0,
                    'totalCGPA' => $results->cgpa ?? 0.0,
                    'letterGrade' => $results->subjectgrade1 ?? 'No Grade',
                    'remarks' => $results->remark ?? 'No Remarks',
                    'failedRemarks' => $results->failed_course ?? 'No failed course',
                    // Safely map course titles, grades, units, and scores
                    'ctitles' => array_map(fn($i) => $results->{"ctitle{$i}"} ?? null, range(1, 17)),
                    'subjects' => array_map(fn($i) => $results->{"subject{$i}"} ?? null, range(1, 16)),
                    'subjectGrades' => array_map(fn($i) => $results->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                    'units' => array_map(fn($i) => $results->{"unit{$i}"} ?? null, range(1, 18)),
                    'scores' => array_map(fn($i) => $results->{"score{$i}"} ?? null, range(1, 19)),
            ];

            // Fetch HOD info and grading system
            $hod = Hod::where('course', $programme)->first();
            $grading = GradingSystem::first();

            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Log student activity
            if (Auth::guard('student')->check()) {
                \App\Models\LogActivity::create([
                    'user_id'      => $student->id ?? null,
                    'ip_address'   => $request->ip(),
                    'activity'     => "Viewed student result for {$acadSession} {$programme} {$level} {$semester} ({$admissionNo})",
                    'activity_date'=> now(),
                ]);
            }

            // Return view
            return view('results.student_result_page_2', [
                'results'     => $results,
                'studentData' => $studentData,
                'semester'    => $semester,
                'grades'      => $grades,
                'hod'         => $hod,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in preview100Second: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function preview300Second($acadSession, $programme, $level, $semester, Request $request)
    {
        try {
            $student = Auth::guard('student')->user();
            $admissionNo = $student->admission_no;

            // Query single student's result
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->where('admission_no', $admissionNo)
                ->first();

            // Handle no result found
            if (!$results) {
                \Log::info("No results found for student {$admissionNo} ({$acadSession} {$programme} {$level} {$semester})");
                return redirect()->route('student-result-preview')->with('error', 'No results found.');
            }

            // Format data for the view
            $studentData = [
                    'stusurname' => $results->student_full_name ?? 'No Name',
                    'stuno' => $results->admission_no ?? 'No Matric No',
                    'class' => $results->class ?? 'No Level',
                    'coursekeep' => $results->course ?? 'No Programme',
                    'studpicture' => $results->picture_dir ?? 'No Picture',
                    'totalGradePoints' => $results->total_grade_point ?? 0,
                    'totalUnits' => $results->total_course_unit ?? 0,
                    'totalGPA' => $results->gpa1 ?? 0.0,
                    'totalGPA2' => $results->gpa2 ?? 0.0,
                    'totalCGPA' => $results->cgpa ?? 0.0,
                    'letterGrade' => $results->subjectgrade1 ?? 'No Grade',
                    'remarks' => $results->remark ?? 'No Remarks',
                    'failedRemarks' => $results->failed_course ?? 'No failed course',
                    'cgpa1' => $results->cgpa1 ?? 0.0,
                    'cgpa2' => $results->cgpa2 ?? 0.0,
                    'cgpa3' => $results->cgpa3 ?? 0.0,
                    'totalCGPANEW' => $results->total_cgpa ?? 0.0,
                    'total_grade_point_new' => $results->total_grade_point_new,
                    'total_course_unit_new' => $results->total_course_unit_new,
                    // Safely map course titles, grades, units, and scores
                    'ctitles' => array_map(fn($i) => $results->{"ctitle{$i}"} ?? null, range(1, 17)),
                    'subjects' => array_map(fn($i) => $results->{"subject{$i}"} ?? null, range(1, 16)),
                    'subjectGrades' => array_map(fn($i) => $results->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                    'units' => array_map(fn($i) => $results->{"unit{$i}"} ?? null, range(1, 18)),
                    'scores' => array_map(fn($i) => $results->{"score{$i}"} ?? null, range(1, 19)),
            ];

            // Fetch HOD info and grading system
            $hod = Hod::where('course', $programme)->first();
            $grading = GradingSystem::first();

            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Log student activity
            if (Auth::guard('student')->check()) {
                \App\Models\LogActivity::create([
                    'user_id'      => $student->id ?? null,
                    'ip_address'   => $request->ip(),
                    'activity'     => "Viewed student result for {$acadSession} {$programme} {$level} {$semester} ({$admissionNo})",
                    'activity_date'=> now(),
                ]);
            }

            // Return view
            return view('results.student_result_page_3', [
                'results'     => $results,
                'studentData' => $studentData,
                'semester'    => $semester,
                'grades'      => $grades,
                'hod'         => $hod,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in preview300Second: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }


}
