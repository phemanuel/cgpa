<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\CourseStudyAll;
use App\Models\CourseStudy;
use App\Models\StudentLevel;
use App\Models\Course;
use App\Models\Department;
use App\Models\Instructor;
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

            // Fetch users with instructor data
            $users = User::where('user_type_status', '3')
                ->withCount('instructors') 
                ->paginate(10);

            $allUsers = User::where('user_type_status', '3')->get();

            return view('layout.instructors', compact('users','allUsers'));
        } catch (\Exception $e) {
            \Log::error('Error fetching instructors: ' . $e->getMessage());
            return redirect('generic-error')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function instructorAssign($id)
    {
        $allLevel = StudentLevel::all();
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allDepartment = Department::all();
        $instructorInfo = User::where('id', $id)->first();
        $instructor = Instructor::where('instructor_id', $id)->paginate(10);

        return view('layout.instructor-assign', compact('allLevel', 'allDepartment', 
        'programmes','instructor','instructorInfo'));


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

    public function getProgrammes(Request $request)
    {
        $request->validate([
            'department' => 'required|string',
        ]);

        // Fetch programmes for the given department
        $programmes = CourseStudy::where('dept', $request->department)
            ->orderBy('dept_name', 'asc')
            ->get();

        return response()->json($programmes);
    }

    public function instructorAssignAction(Request $request)
    {
        try {
            // Validate incoming data
            $request->validate([
                'acadSession' => 'required|string',
                'department' => 'required|string',
                'programme' => 'required|string',
                'stdLevel' => 'required|string',
                'semester' => 'required|string',
                'courseId' => 'required|exists:course,id', // Ensure the course exists
                'instructorId' => 'required|exists:users,id', // Ensure instructor exists
            ]);
    
            // Check if the course is already assigned to an instructor
            $existingAssignment = Instructor::where([
                ['department', '=', $request->department],
                ['programme', '=', $request->programme],
                ['level', '=', $request->stdLevel],
                ['semester', '=', $request->semester],
                ['session1', '=', $request->acadSession],
                ['course_id', '=', $request->courseId],
            ])->first();
    
            if ($existingAssignment) {
                $existingId = $existingAssignment->id;
    
                // Redirect to the reassignment page with relevant data
                return redirect()->route('instructor-reassign', [
                    'id' => $existingId,
                ])->with('info', 'This course is already assigned to an instructor. Please confirm if you want to reassign to another instructor.');
            }
    
            // Fetch instructor and course information
            $instructorInfo = User::findOrFail($request->instructorId);
            $courseInfo = Course::findOrFail($request->courseId);
    
            // Create a new assignment record
            $assignment = Instructor::create([
                'instructor_id' => $request->instructorId,
                'instructor_name' => $instructorInfo->last_name . ' ' . $instructorInfo->first_name,
                'department' => $request->department,
                'programme' => $request->programme,
                'level' => $request->stdLevel,
                'semester' => $request->semester,
                'session1' => $request->acadSession,
                'course_id' => $request->courseId,
                'course_title' => $courseInfo->course_title,
                'course_code' => $courseInfo->course_code,
                'course_unit' => $courseInfo->course_unit,
                'assign_status' => 'Active',
            ]);
    
            if ($assignment) {
                // Update the user's department in the `users` table
                $instructorInfo->update(['department' => $request->department]);
                //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => "{$courseInfo->course_title} assigned to {$instructorInfo->last_name} {$instructorInfo->first_name} by " . auth()->user()->last_name . ' ' . auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }
                return redirect()->route('instructor-assign', ['id' => $request->instructorId])
                    ->with('success', 'Course assigned successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to assign course.');
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error assigning course: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while assigning the course. Please try again later.');
        }
    }

    public function instructorReassign($id)
    {
        $courseInfo = Instructor::where('id', $id)->first();
        $instructorInfo = User::where('id', $courseInfo->instructor_id)->first();
        $instructors = User::where('user_type_status', 3)
        ->get();

        return view('layout.instructor-reassign', compact('instructorInfo', 'courseInfo','instructors'));
    }

    public function instructorReassignAction(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'instructorId' => 'required|exists:users,id',
            'assignId'     => 'required|exists:instructors,id',
        ]);

        // Get the new instructor and course
        $newInstructor = User::find($validatedData['instructorId']);
        $instructorName = $newInstructor->last_name . ' ' . $newInstructor->first_name;
        $course = Instructor::find($validatedData['assignId']);

        if (!$newInstructor || !$course) {
            return redirect()->back()->with('error', 'Invalid instructor or assign details.');
        }

        // Update the instructor details in the course
        $course->update([
            'instructor_id' => $newInstructor->id,
            'instructor_name' => $instructorName,
        ]);        
        //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => "{$course->course_title} re-assigned to {$instructorName} by " . auth()->user()->last_name . ' ' . auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }

        return redirect()->route('instructor-assign',['id' => $newInstructor->id ])->with('success', 'Course re-assigned successfully.');
    }

    public function showDetails($id)
    {
        // Log the incoming request with the instructor ID
        Log::info('Request to fetch instructor details for ID: ' . $id);

        // Try to find the instructor by ID
        $instructor = User::find($id);

        // If the instructor is not found, log an error and return a 404 response
        if (!$instructor) {
            Log::error('Instructor not found for ID: ' . $id);
            return response()->json(['error' => 'Instructor not found'], 404);
        }
        
        // Return the instructor details as JSON
        return response()->json([
            'name' => $instructor->last_name . ' ' . $instructor->first_name,
            'email' => $instructor->email,
            'department' => $instructor->department,
            'image' => $instructor->image
        ]);
    }

    public function instructorUnassign($id)   
    {   
        $user = auth()->user();
        $instructorCourse = Instructor::where('id', $id)->first();  
        $instructorId = $instructorCourse->instructor_id;      
        $instructorCourse->delete();

        //---Log Activity------
                if (auth()->check()) {
                    \App\Models\LogActivity::create([
                        'user_id' => auth()->id(),
                        'ip_address' => request()->ip(),
                        'activity' => "{$instructorCourse->course_title} unassigned from {$instructorCourse->instructor_name} by " . auth()->user()->last_name . ' ' . auth()->user()->first_name,
                        'activity_date' => now(),
                    ]);
                }

        // Redirect back to the course list with success message and parameters
        return redirect()->route('instructor-assign', [
            'id' => $instructorId,
        ])->with('success', 'Course unassigned successfully!');
    }




}
