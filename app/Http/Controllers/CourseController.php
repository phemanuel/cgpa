<?php

namespace App\Http\Controllers;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\Course;
use App\Models\Department;
use App\Models\hod;
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

    public function courseEdit($id)
    {
        $course = Course::find($id);

        // Check if the course exists
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found!');
        }

        return view('layout.course-edit', compact('course'));

    }

    public function courseEditAction(Request $request, $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'programme' => 'required|string',
            'stdLevel' => 'required|string',
            'semester' => 'required|string',
            'acadSession' => 'required|string',
            'courseTitle' => 'required|string|unique:course,course_title,' . $id, // Ignore unique check for the current course
            'courseCode' => 'required|string',
            'courseUnit' => 'required|numeric',
        ]);

        // Find the course to update
        $course = Course::find($id);

        // Check if course exists
        if (!$course) {
            return redirect()->route('course-list')->with('error', 'Course not found!');
        }

        // Update the course data
        $course->course_title = $request->courseTitle;
        $course->course_code = $request->courseCode;
        $course->course_unit = $request->courseUnit;
        $course->course = $request->programme;
        $course->level = $request->stdLevel;
        $course->semester = $request->semester;
        $course->session1 = $request->acadSession;
        $course->save();

        // Redirect back to course list with success message
        return redirect()->route('course-list', [
            'programme' => $course->course,
            'semester' => $course->semester,
            'stdLevel' => $course->level,
        ])->with('success', 'Course updated successfully!');
    }

    public function hodSetup()
    {
        $user = auth()->user();
        $rolePermission = $user->hod_setup;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        $allHod = hod::all();

        return view('layout.hod', compact('allHod'));
    }

    public function hodAdd()
    {
        $allCourse = CourseStudyAll::all();
        $allDepartment = Department::all();

        return view('layout.hod-add', compact('allCourse', 'allDepartment'));
    }

    public function hodAddAction(Request $request)
    {
        // Validate the form input
        $request->validate([
            'department' => 'required|string|max:255',
            'programme' => 'required|string|max:255',
            'fullName' => 'required|string|max:255',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if HOD already exists for the department and programme
        $existingHod = Hod::where('dept', $request->department)
            ->where('course', $request->programme)
            ->first();

        if ($existingHod) {
            return back()->with('error', 'An HOD already exists for this department and programme.');
        }

        // Generate a unique file name
        $signatureFile = $request->file('signature');
        $generatedFileName = uniqid() . '.' . $signatureFile->getClientOriginalExtension();

        // Save the file to the public/signature directory
        $signatureFile->move(public_path('signature'), $generatedFileName);

        // Save the HOD record
        Hod::create([
            'dept' => $request->department,
            'course' => $request->programme,
            'hod_name' => $request->fullName,
            'sign' => $generatedFileName, // Save only the generated file name
        ]);


        return redirect()->route('hod-setup')->with('success', 'HOD added successfully.');
    }

    public function hodEdit($id)
    {
        $hod = hod::find($id);

        return view('layout.hod-edit', compact('hod'));
    }

    public function hodEditAction(Request $request, $id)
    {
        // Validate the form input
        $request->validate([
            'department' => 'required|string|max:255',
            'programme' => 'required|string|max:255',
            'fullName' => 'required|string|max:255',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the HOD record
        $hod = Hod::findOrFail($id);

        // Update the HOD details
        // $hod->dept = $request->department;
        // $hod->course = $request->programme;
        $hod->hod_name = $request->fullName;

        // Handle signature file if uploaded
        if ($request->hasFile('signature')) {
            // Delete the old signature file if it exists
            $oldSignaturePath = public_path('signature/' . $hod->signature);
            if (file_exists($oldSignaturePath)) {
                unlink($oldSignaturePath);
            }

            // Save the new signature file
            $signatureFile = $request->file('signature');
            $generatedFileName = uniqid() . '.' . $signatureFile->getClientOriginalExtension();
            $signatureFile->move(public_path('signature'), $generatedFileName);

            // Update the signature field in the database
            $hod->signature = $generatedFileName;
        }

        // Save the updated record
        $hod->save();

        return redirect()->route('hod-setup')->with('success', 'HOD updated successfully.');
    }

    public function hodDelete($id)
    {
        // Find the HOD record
        $hod = hod::findOrFail($id);

        // Delete the signature file if it exists
        if ($hod->signature) {
            $signaturePath = public_path('signature/' . $hod->signature);
            if (file_exists($signaturePath)) {
                unlink($signaturePath);
            }
        }

        // Delete the HOD record
        $hod->delete();

        return redirect()->route('hod-setup')->with('success', 'HOD deleted successfully.');
    }


}
