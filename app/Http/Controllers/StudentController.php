<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use App\Models\StudentLevel;
use App\Models\CourseStudy;
use App\Models\CourseStudyAll;
use Validator;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

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

        return redirect()->route('student-registration')->with('success', 'Student data saved successfuly.');
        // return response()->json(['success' => true]);
    }

    public function import()
    {

    }


    public function studentMigration()
    {
        return redirect()->route('page-development');        
    }

    public function studentMenu()
    {
        return view('layout.student-menu');
    }
}
