<?php

namespace App\Http\Controllers;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function courseSetup()
    {
        $user = auth()->user();
        $rolePermission = $user->course_setup;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        $allLevel = StudentLevel::all();
        $programmes = CourseStudyAll::all();

        return view('layout.course', compact('allLevel','programmes'));
    }

    public function courseList(Request $request)
    {
        try {
            // Get the query parameters (fallback to default if not present)
            $programme = $request->query('programme', '');
            $semester = $request->query('semester', '');
            $stdLevel = $request->query('stdLevel', '');

            // Validate the inputs
            if (empty($programme) || empty($semester) || empty($stdLevel)) {
                return redirect()->back()->with('error', 'All filters are required.');
            }

            // Fetch paginated results
            $courses = Course::where('semester', $semester)
                ->where('course', $programme)
                ->where('level', $stdLevel)
                ->orderBy('course_title', 'asc')
                ->get();             

            if ($courses->isEmpty()) {
                return redirect()->back()->with('error', 'No course found for the selected filters.');
            }

            return view('layout.course-list-view', [
                'courses' => $courses,
                'studentLevel' => $stdLevel,
                'programme' => $programme,
                'semester' => $semester,
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

    public function courseAdd(Request $request)
    {
        // Get the parameters from the request
        $programme = $request->input('programme');
        $studentLevel = $request->input('studentLevel');
        $semester = $request->input('semester');

        // Check if any of the parameters are empty, and redirect back to the 'course-setup' route
        if (empty($programme) || empty($studentLevel) || empty($semester)) {
            return redirect()->route('course-setup')->with('error', 'All fields are required.');
        }

        // Continue with the flow if parameters are not empty
        return view('layout.course-add', compact('programme', 'studentLevel', 'semester'));
    }

    public function courseAddAction(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'programme' => 'required|string',
            'stdLevel' => 'required|string',
            'semester' => 'required|string',
            'acadSession' => 'required|string',
            'courseTitle' => 'required|string|unique:course,course_title', // Unique within courses
            'courseCode' => 'required|string',
            'courseUnit' => 'required|numeric',
        ]);

        // Check if a course with the same combination of course_title, programme, level, unit, and semester already exists
        $existingCourse = Course::where([
            ['course_title', '=', $request->courseTitle],
            ['course', '=', $request->programme],
            ['level', '=', $request->stdLevel],
            ['course_unit', '=', $request->courseUnit],
            ['semester', '=', $request->semester],
            ['session1', '=', $request->acadSession],
        ])->first();

        // If a duplicate exists, return back with an error message
        if ($existingCourse) {
            return redirect()->back()->with('error', 'This course already exists with the same details.')->withInput();
        }

        // Create a new course
        $course = new Course();
        $course->course_title = $request->courseTitle;
        $course->course_code = $request->courseCode;
        $course->course_unit = $request->courseUnit;
        $course->course = $request->programme;
        $course->level = $request->stdLevel;
        $course->semester = $request->semester;
        $course->session1 = $request->acadSession;
        $course->save();

        // Redirect to the course-list route with the necessary parameters
        return redirect()->route('course-list', [
            'programme' => $request->programme,
            'semester' => $request->semester,
            'stdLevel' => $request->stdLevel
        ])->with('success', 'Course added successfully!');
    }

    public function courseDelete($id)
    {
        // Fetch the course by ID
        $course = Course::find($id);

        // Check if the course exists
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found!');
        }

        // Fetch the programme, semester, and stdLevel associated with the course
        $programme = $course->course;
        $semester = $course->semester;
        $stdLevel = $course->level;

        // Delete the course
        $course->delete();

        // Redirect back to the course list with success message and parameters
        return redirect()->route('course-list', [
            'programme' => $programme,
            'semester' => $semester,
            'stdLevel' => $stdLevel,
        ])->with('success', 'Course deleted successfully!');
    }



}
