<?php
use App\Http\Controllers\MailController;
use App\Http\Controllers\AuthController;
//use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CustomForgotPasswordController;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//------Reset Password Route
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [CustomForgotPasswordController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}/{email}', function ($token,$email) {
    return view('auth.user-reset-password', ['token' => $token , 'email' => $email]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [CustomForgotPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

    // Home route
    Route::get('/', [AuthController::class, 'home'])->name('home');
    // Login and signup routes
    Route::get('user-login', [AuthController::class, 'login'])->name('login');
    Route::post('user-login', [AuthController::class, 'loginAction'])->name('login.action');
    
    Route::get('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('signup', [AuthController::class, 'signupAction'])->name('signup.action');

    //----Auth routes--
    //---Admin Routes
    Route::middleware('auth')->prefix('admin')->group(function () {       
    
        // Logout route
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        
        // Profile routes
        Route::get('account-setting/{id}', [AuthController::class, 'profileUpdate'])
        ->name('account-setting');
        Route::get('profile-picture', [AuthController::class, 'profilePicture'])
        ->name('profile-picture');
        Route::post('profile-picture/update', [AuthController::class, 'profilePictureUpdate'])
        ->name('profile-picture-update');
        
        Route::get('dashboard', [DashboardController::class, 'indexAdmin'])
        ->name('admin-dashboard');   
        Route::get('account/setting/{id}', [AuthController::class, 'profileUpdateAdmin'])
        ->name('admin-account-setting'); 
        Route::get('transcript/request', [DashboardController::class, 'transcriptRequest'])
        ->name('transcript-request'); 
        Route::get('transcript/request/view/{id}', [DashboardController::class, 'transcriptRequestView'])
        ->name('transcript-request-view'); 
        Route::post('transcript/request/view/{id}', [DashboardController::class, 'transcriptRequestAction'])
        ->name('transcript-request.action'); 
        Route::get('transcript/upload/{id}', [DashboardController::class, 'transcriptUpload'])
        ->name('transcript-upload'); 
        Route::post('transcript/upload/{id}', [DashboardController::class, 'transcriptUploadAction'])
        ->name('transcript-upload.action'); 
        Route::get('user/transcript/upload', [DashboardController::class, 'userTranscriptUpload'])
        ->name('user-transcript-upload');
        Route::get('user', [DashboardController::class, 'UserMenu'])
        ->name('user-menu'); 
        Route::get('users/view', [DashboardController::class, 'Users'])
        ->name('users'); 
        Route::get('user/add', [DashboardController::class, 'addUser'])
        ->name('add-user'); 
        Route::post('user/add', [DashboardController::class, 'addUserAction'])
        ->name('add-user.action'); 
        Route::get('user/edit/{id}', [DashboardController::class, 'editUser'])
        ->name('edit-user');
        Route::put('user/edit/{id}', [DashboardController::class, 'editUserAction'])
        ->name('edit-user.action'); 
        Route::get('student/edit/{id}', [DashboardController::class, 'editStudent'])
        ->name('edit-student');
        Route::put('student/edit/{id}', [DashboardController::class, 'editStudentAction'])
        ->name('edit-student.action');

        //---Class List
        Route::get('class-list', [DashboardController::class, 'classList'])
        ->name('class-list'); 
        Route::get('class-list/view', [DashboardController::class, 'classListAction'])
        ->name('class-list.action'); 
        //----Student
        Route::get('students', [StudentController::class, 'students'])
        ->name('student'); 
        Route::get('student', [StudentController::class, 'studentMenu'])
        ->name('student-menu');
        Route::get('student/registration', [StudentController::class, 'studentRegistration'])
        ->name('student-registration'); 
        Route::get('student/migration', [studentController::class, 'studentMigration'])
        ->name('student-migration'); 
        //---Result
        Route::get('result', [ResultController::class, 'resultMenu'])
        ->name('result-menu');
        Route::get('result/entry', [ResultController::class, 'resultEntry'])
        ->name('result-entry');
        Route::get('result/entry/{id}', [ResultController::class, 'resultEntryView'])
        ->name('result-entry.view');
        Route::get('result/compute', [ResultController::class, 'resultCompute'])
        ->name('result-compute');
        Route::get('result/semester', [ResultController::class, 'semesterResult'])
        ->name('semester-result');
        Route::get('result/summary', [ResultController::class, 'semesterSummary'])
        ->name('semester-summary');
        Route::get('result/cgpa', [ResultController::class, 'cgpaSummary'])
        ->name('cgpa-summary');
        Route::get('result/transcript', [ResultController::class, 'studentTranscript'])
        ->name('student-transcript');
        //---course
        Route::get('course', [CourseController::class, 'courseSetup'])
        ->name('course-setup');
        Route::get('course/list', [CourseController::class, 'courseList'])
        ->name('course-list');
        Route::get('course/add', [CourseController::class, 'courseAdd'])
        ->name('course-add');
        Route::post('course/add', [CourseController::class, 'courseAddAction'])
        ->name('course-add.action');
        Route::get('course/edit/{id}', [CourseController::class, 'courseEdit'])
        ->name('course-edit');
        Route::put('course/edit/{id}', [CourseController::class, 'courseEditAction'])
        ->name('course-edit.action');
        Route::get('course/delete/{id}', [CourseController::class, 'courseDelete'])
        ->name('course-delete');
        Route::get('course/assign/{id}', [CourseController::class, 'courseAssign'])
        ->name('course-assign');
        Route::post('course/assign', [CourseController::class, 'courseAssignAction'])
        ->name('course-assign.action');
        //---
        Route::get('instructors', [InstructorController::class, 'instructors'])
        ->name('instructors');
        Route::get('instructor/assign/{id}', [InstructorController::class, 'instructorAssign'])
        ->name('instructor-assign');
        Route::post('instructor/assign', [InstructorController::class, 'instructorAssignAction'])
        ->name('instructor-assign.action');
        Route::get('instructor/reassign/{id}', [InstructorController::class, 'instructorReassign'])
        ->name('instructor-reassign');
        Route::post('instructor/reassign', [InstructorController::class, 'instructorReassignAction'])
        ->name('instructor-reassign.action');
        Route::get('instructor-details/{id}', [InstructorController::class, 'showDetails'])
        ->name('instructor.details');
        Route::get('instructor/unassign/{id}', [InstructorController::class, 'instructorUnassign'])
        ->name('instructor-unassign');
        

        Route::post('/get-courses', [InstructorController::class, 'getCourses'])
        ->name('get-courses');
        Route::post('/get-programmes', [InstructorController::class, 'getProgrammes'])
        ->name('get-programmes');
        //---HOD
        Route::get('hod', [CourseController::class, 'hodSetup'])
        ->name('hod-setup');
        Route::get('hod/add', [CourseController::class, 'hodAdd'])
        ->name('hod-add');
        Route::post('hod/add', [CourseController::class, 'hodAddAction'])
        ->name('hod-add.action');
        Route::get('hod/edit/{id}', [CourseController::class, 'hodEdit'])
        ->name('hod-edit');
        Route::put('hod/edit/{id}', [CourseController::class, 'hodEditAction'])
        ->name('hod-edit.action');
        Route::get('hod/delete/{id}', [CourseController::class, 'hodDelete'])
        ->name('hod-delete');
        //----Grading
        Route::get('grading', [ResultController::class, 'gradingSystem'])
        ->name('grading');
        Route::get('grading/edit', [ResultController::class, 'gradingSystemEdit'])
        ->name('grading-edit');
        Route::put('grading/edit', [ResultController::class, 'gradingSystemEditAction'])
        ->name('grading-edit.action');
        //------------------
        Route::get('score-sheet', [ResultController::class, 'scoreSheet'])
        ->name('score-sheet');
        //---------
        Route::get('page/development', [DashboardController::class, 'pageDevelopment'])
        ->name('page-development');

        //--Send mail routes
        Route::get('send-mail-fail/{transaction_id}', [MailController::class, 'mailFailed'])
        ->name('send-mail-fail');
        Route::get('send-mail-success/{transaction_id}', [MailController::class, 'mailSuccess'])
        ->name('send-mail-success');
        //---User change password --------------------------------
        Route::get('change-password', [AuthController::class, 'changePassword'])
            ->name('change-password');  
    });

    //---Student Routes
    Route::middleware('auth')->prefix('student')->group(function () {  
        Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');        
        Route::get('request', [DashboardController::class, 'userRequest'])
        ->name('user-request');
        Route::post('request', [DashboardController::class, 'userRequestAction'])
        ->name('user-request.action'); 
        //--Payment routes--
        Route::get('payment', [DashboardController::class, 'userPayment'])
        ->name('user-payment');
        Route::get('payment-check', [DashboardController::class, 'paymentCheck'])
        ->name('payment-check');
        Route::get('payment-error', [DashboardController::class, 'paymentError'])
        ->name('payment-error');
        Route::get('payment-report', [DashboardController::class, 'paymentReport'])
        ->name('payment-report');    
        Route::get('payment-status', [DashboardController::class, 'paymentStatus'])
        ->name('payment-status'); 
        Route::get('contact-us', [DashboardController::class, 'contactUs'])
        ->name('contact-us');

    });
    
    Route::get('test-file', [DashboardController::class, 'testFile'])
    ->name('test-file');
    
        //===========Verify email address routes================================
    Route::get('email-verify', [MailController::class, 'emailVerify'])
    ->name('email-verify');
    Route::get('email-verify-done/{token}', [MailController::class, 'emailVerifyDone'])
    ->name('email-verify-done');
    Route::post('resend-verification-email', [MailController::class, 'resendEmailVerification'])
    ->name('resend-verification-email');
    Route::post('resend-verification', [MailController::class, 'resendVerification'])
    ->name('resend-verification');
    Route::post('email-not-verify', [MailController::class, 'emailNotVerify'])
    ->name('email-not-verify');
    
    //----send mail route
    Route::get('send-mail', [MailController::class, 'index'])
    ->name('send-mail');

    Route::get('user-check', [DashboardController::class, 'userCheck'])
        ->name('user-check');
    
   