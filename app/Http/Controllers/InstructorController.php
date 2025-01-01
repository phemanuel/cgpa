<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    //

    public function instructors()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->instructors;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }
        
            $users = User::where('user_type_status', '3')->paginate(10);
            $allUsers = User::where('user_type_status', '3')->get();
            
            return view('layout.instructors', compact('users', 'allUsers'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

    public function instructorAssign($id)
    {
        $allLevel = StudentLevel::all();
        $programmes = CourseStudyAll::all();
        $allDepartment = Department::all();

        return view('layout.instructor-assign', compact('allLevel', 'allDepartment', 'programmes'));


    }  

    public function getCourses(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Fetching courses with request data:', $request->all());

            // Validate the request
            $validatedData = $request->validate([
                'department' => 'required|string',
                'programme' => 'required|string',
                'stdLevel' => 'required|string',
                'semester' => 'required|string',
            ]);

            // Log the validated data
            Log::info('Validated request data:', $validatedData);

            // Fetch courses matching the criteria
            $courses = Course::where('course', $request->programme) 
                ->where('level', $request->stdLevel)
                ->where('semester', $request->semester)
                ->get();

            // Log the fetched courses
            Log::info('Courses fetched:', $courses->toArray());

            return response()->json($courses);
        } catch (\Exception $e) {
            // Log the error message and exception details
            Log::error('Error fetching courses:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return an error response
            return response()->json([
                'error' => 'An error occurred while fetching courses.',
            ], 500);
        }
    }

}
