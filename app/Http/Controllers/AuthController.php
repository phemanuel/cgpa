<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;

use App\Models\FailedLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Storage;
//use Image;

class AuthController extends Controller
{
    //
    public function home()
    {
        return view('auth.user-login');
    }

    public function login()
    {
        return view('auth.user-login');
    }

    public function studentLogin()
    {
        return view('auth.student-login');
    }

    public function signup()
    {
        return view('auth.user-signup');
    }

    public function signupAction(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $email_token =Str::random(40);            

            $user = User::create([
                'last_name' => $validatedData['last_name'],
                'first_name' => $validatedData['first_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),                
                'email_verified_status' => 0,
                'login_attempts' => 0,
                'remember_token' => $email_token,
                // 'user_picture' => 'profile_pictures/blank.jpg',
                'user_type' => 'user',                
            ]);

            $email_message = "We have sent instructions to verify your email, kindly follow instructions to continue, 
            please check both your inbox and spam folder.";
            session(['email' => $validatedData['email']]);
            session(['full_name' => $validatedData['first_name']]);
            session(['email_token' => $email_token]);
            session(['email_message' => $email_message]);


            return redirect('send-mail');
        } catch (ValidationException $e) {
            // Validation failed. Redirect back with validation errors.
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log the error
            Log::error('Error during user registration: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    public function loginAction(Request $request)
    {
        // return response()->json([
        //     'status' => 'success',
        // ]);
        try {
            validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ])->validate();
                
            $userLog = User::where('email', $request->input('email'))->first();
            if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                //---check the no of attempts=====
                if($userLog->login_attempts < 5){
                    //--increment the number of attempts
                    $userLog->increment('login_attempts');
                    // Log the failed login attempt into the failed_logins table.
                    FailedLogins::create([
                    'ip_address' => $request->ip(),
                    'email' => $request->input('email'),
                ]);
                }
                elseif($userLog->login_attempts >= 5){
                    return redirect()->route('user-locked')->with('seconds', '60');
                }                
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed')
                ]);
            }            

            // User is authenticated at this point
            $user = Auth::user();
            //---reset the user login attempts----
            Auth::user()->update(['login_attempts' => 0]);
        
            if ($user->user_status == 'Active') {
                // Email is verified, proceed with login
                $request->session()->regenerate();
                //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => 'New login by ' . auth()->user()->last_name . ' '. auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }
                if($user->user_type == 'Superadmin'){
                    return redirect()->route('admin-dashboard');
                }
                else if($user->user_type == 'Admin'){
                    return redirect()->route('admin-dashboard');
                }
                else if($user->user_type == 'Instructor'){
                    return redirect()->route('admin-dashboard');
                }
                elseif($user->user_type == 'Student'){
                    return redirect()->route('dashboard');
                }
                
            } else {                    
                // Email is not verified, return a flash message
                //Auth::logout(); // Log the user out since the email is not verified                    
                // $email_address = $request->email;         
                //  return view('auth.email-not-verify');
                Auth::logout();
                return redirect()->route('login')->with('error', 
                'You have been deactivated, please reach out to the administrator.');
                 
            }
        } catch (ValidationException $e) {
            // Handle the validation exception
            // You can redirect back with errors or do other appropriate error handling
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->route('login')->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Handle other exceptions, log them, and redirect to an error page
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->route('login');
        }    
    }    

    public function studentLoginAction(Request $request)
    {
        $request->validate([
            'matricNo' => 'required|string',
            'password' => 'required|string',
        ]);        

        $student = Registration::where('admission_no', $request->matricNo)->first();       

        if (!$student) {
            return back()->with('error', 'Matric number not found.');
        }
        
        // If student has no password, prompt to set up
        if (empty($student->password)) {
            session(['setup_matric' => $student->admission_no]);
            session()->save(); 
            return redirect()->route('student-setup-password')
                ->with('info', 'Please set up your password to continue.');
        }

        // Validate password
        if (!Hash::check($request->password, $student->password)) {
            return back()->with('error', 'Invalid password.');
        }

        // ✅ Log in using the custom guard
        Auth::guard('student')->login($student);

        return redirect()->route('dashboard')->with('success', 'Login successful.');
    }

    public function showSetupPasswordForm()
    {
        // dd(session('setup_matric'));
        // If no session matric, block direct access
        if (!session()->has('setup_matric')) {
            return redirect()->route('student-login')->with('error', 'Unauthorized access.');
        }

        $matricNo = session('setup_matric');
        return view('layout.student-password', compact('matricNo'));
    }


    public function saveSetupPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!session()->has('setup_matric')) {
            return redirect()->route('student-login')->with('error', 'Session expired, please log in again.');
        }

        $matricNo = session('setup_matric');
        $student = Registration::where('admission_no', $matricNo)->first();

        if (!$student) {
            return redirect()->route('student-login')->with('error', 'Student record not found.');
        }

        // Save hashed password
        $student->password = Hash::make($request->password);
        $student->save();

        // Clear session
        session()->forget('setup_matric');

        return redirect()->route('student-login')
            ->with('success', 'You have successfully set up your password. You can now log in.');
    }

    

    //----update user profile
    public function profileUpdate(Request $request, string $id)
    {
        return view('auth.account-setting');        
        
    
    }

    public function profileUpdateAction(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNo' => 'nullable|string|max:20',
            'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:6|confirmed' 
        ]);

        try {
            // Handle profile picture
            if ($request->hasFile('profilePicture')) {
                $file = $request->file('profilePicture');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('profile_pictures'), $filename);
                $user->image = $filename;
            } elseif (!$user->image || !file_exists(public_path('profile_pictures/' . $user->image))) {
                $user->image = 'blank.jpg';
            }

            // Update personal info
            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->phone_no = $request->input('phoneNo');

            // Check if user wants to update password
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
                $user->save();

                // Log out after password change
                Auth::logout();
                return redirect()->route('login')->with('success', 'Password changed successfully. Please login again.');
            }

            $user->save();
            return redirect()->back()->with('success', 'Account settings updated successfully.');

        } catch (\Exception $e) {
            \Log::error('Error updating account settings: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating your profile.');
        }
    }

    public function profileUpdateAdmin(Request $request, string $id)
    {
        return view('auth.account-setting');
    
    }

    //----update user profile
    public function profileUpdateSocial(Request $request, string $id)
    {
        try {
            $rules = [
                'user_facebook' => 'url|nullable',
                'user_instagram' => 'url|nullable',
                'user_twitter' => 'url|nullable',
                'user_linkedin' => 'url|nullable',
            ];
        
            $validatedData = $request->validate($rules);
        
            $user = User::findOrFail($id);
            $user->update($validatedData);
        
            return redirect()->route('user-about')->with('success-new', 'Socials update successful.');
        } catch (\Exception $e) {
            // Handle the exception, log the error, and return with an error message
            \Log::error('Error updating social links: ' . $e->getMessage());
        
            return redirect()->route('user-about')->with('error', 'An error occurred while updating your social links. Please try again.');
        }        
    
    }

    public function profilePicture()
    {
        return view('dashboard.user-profile-picture');

    }

    //update profile picture
    public function profilePictureUpdate(Request $request)
    {
        $user = auth()->user();

        try {
            if ($request->hasFile('profile_picture')) {
                $userPictureFile = $request->file('profile_picture');
                $profilePictureFile = $request->file('profile_picture');
        
                $username = $user->user_name_link; // Get the user's username
        
                // Generate filenames for both pictures
                $userPictureFilename = $username . '_user_picture.' . $userPictureFile->getClientOriginalExtension();
                $profilePictureFilename = $username . '_profile_picture.' . $profilePictureFile->getClientOriginalExtension();
        
                // Store both pictures with the customized filenames
                $userPicturePath = $userPictureFile->storeAs('profile_pictures', $userPictureFilename, 'public');
                $profilePicturePath = $profilePictureFile->storeAs('profile_pictures', $profilePictureFilename, 'public');
        
                // Resize and save the user_picture
                $userPicture = Image::make(public_path('storage/' . $userPicturePath));
                $userPicture->fit(300, 300); // Adjust dimensions as needed
                $userPicture->save();
        
                // Resize and save the profile_picture
                $profilePicture = Image::make(public_path('storage/' . $profilePicturePath));
                $profilePicture->fit(668, 690); // Adjust dimensions as needed
                $profilePicture->save();
        
                // Update user's profile pictures in the database
                $user->user_picture = $userPicturePath;
                $user->profile_picture = $profilePicturePath;
                $user->save();
        
                return redirect()->route('profile-picture')->with('success', 'Profile picture updated successfully.');
            }
        
            return redirect()->route('profile-picture')->with('error', 'Both user and profile picture must be provided.');
        } catch (\Exception $e) {
            // Handle the exception, log the error, and return with an error message
            \Log::error('Error updating profile pictures: ' . $e->getMessage());
        
            return redirect()->route('profile-picture')->with('error', 'An error occurred while updating profile pictures. Please try again.');
        }  

    }    

    public function changePassword(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');


    }

    public function studentLogout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student-login')->with('success', 'You have been logged out.');
    }
    
    public function userLocked()
    {
        return view('auth.locked-out')->with('seconds', '60');
    }
}