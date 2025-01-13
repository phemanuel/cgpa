<?php

namespace App\Http\Controllers;
use App\Models\GradingSystem;
use App\Models\Instructor;
use App\Models\Registration;
use App\Models\Result;
use App\Models\Course;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    //
    public function resultMenu()
    {
        return view('layout.result-menu');
    }

    public function gradingSystem()
    {
        $user = auth()->user();
        $rolePermission = $user->grading_system;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        $grading = GradingSystem::first();

        return view('layout.grading', compact('grading'));
    }

    public function gradingSystemEdit()
    {
        $grading = GradingSystem::first();

        return view('layout.grading-edit', compact('grading'));
    }

    public function gradingSystemEditAction(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'grade01' => 'required|integer|min:0|max:100',
                'grade02' => 'required|integer|min:0|max:100',
                'unit01' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade1' => 'required|string|max:4',
                'grade11' => 'required|integer|min:0|max:100',
                'grade12' => 'required|integer|min:0|max:100',
                'unit02' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade2' => 'required|string|max:4',
                'grade21' => 'required|integer|min:0|max:100',
                'grade22' => 'required|integer|min:0|max:100',
                'unit03' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade3' => 'required|string|max:4',
                'grade31' => 'required|integer|min:0|max:100',
                'grade32' => 'required|integer|min:0|max:100',
                'unit04' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade4' => 'required|string|max:4',
                'grade41' => 'required|integer|min:0|max:100',
                'grade42' => 'required|integer|min:0|max:100',
                'unit05' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade5' => 'required|string|max:4',
                'grade51' => 'required|integer|min:0|max:100',
                'grade52' => 'required|integer|min:0|max:100',
                'unit06' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', // Allow decimal values (up to 2 decimal places)
                'lgrade6' => 'required|string|max:4',
            ]);

            // Assuming there's a single grading record to update
            $grading = GradingSystem::first();

            if (!$grading) {
                return redirect()->back()->withErrors('Grading record not found.');
            }

            // Update the grading record
            $grading->update([
                'grade01' => $validated['grade01'],
                'grade02' => $validated['grade02'],
                'unit01' => $validated['unit01'],
                'lgrade1' => $validated['lgrade1'],
                'grade11' => $validated['grade11'],
                'grade12' => $validated['grade12'],
                'unit02' => $validated['unit02'],
                'lgrade2' => $validated['lgrade2'],
                'grade21' => $validated['grade21'],
                'grade22' => $validated['grade22'],
                'unit03' => $validated['unit03'],
                'lgrade3' => $validated['lgrade3'],
                'grade31' => $validated['grade31'],
                'grade32' => $validated['grade32'],
                'unit04' => $validated['unit04'],
                'lgrade4' => $validated['lgrade4'],
                'grade41' => $validated['grade41'],
                'grade42' => $validated['grade42'],
                'unit05' => $validated['unit05'],
                'lgrade5' => $validated['lgrade5'],
                'grade51' => $validated['grade51'],
                'grade52' => $validated['grade52'],
                'unit06' => $validated['unit06'],
                'lgrade6' => $validated['lgrade6'],
            ]);

            return redirect()->route('grading')->with('success', 'Grading System updated successfully.');

        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error updating grading system: ' . $e->getMessage());

            // Return an error response
            return redirect()->back()->withErrors('An error occurred while updating the grading system. Please try again.');
        }
    }

    public function scoreSheet()
    {
        $user = auth()->user();
        $rolePermission = $user->score_sheet;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        return redirect()->route('page-development');
    }

    public function resultEntry()
    {
        $user = auth()->user();
        $rolePermission = $user->result_entry;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }

        if($user->user_type_status == 1 OR $user->user_type_status == 2) {
            return redirect()->route('result-entry-admin');
        }
        else{
            $assignedCourse = Instructor::where('instructor_id', $user->id)->get();

            if($assignedCourse->count() == 0) {
                return redirect()->back()->with('error','You have not been assigned to any courses.');
            }

            return view('layout.result-entry', compact('assignedCourse'));
        }
        
    }

    public function resultEntryAdmin()
    {
        $user = auth()->user();
        $rolePermission = $user->result_entry;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }
        
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allLevel = StudentLevel::all();

        return view('layout.result-entry-admin', compact('programmes','allLevel'));
    }



    // public function resultEntryView($id)
    // {
    //     // Fetch the assigned course details
    //     $assignedCourse = Instructor::where('id', $id)->first();
    //     $admissionYear = $assignedCourse->session1;
    //     $year = substr($admissionYear, 0, 4);
    //     // Fetch students based on the programme and level
    //     $students = Registration::where('course', $assignedCourse->programme)
    //         ->where('class', $assignedCourse->level)
    //         // ->where('admission_year',  $year)
    //         ->where('admission_year', '2023')
    //         ->get();
        
    //         if($students->count() == 0){
    //             return redirect()->back()->with('error','There are no students available for the admission period.');
    //         }

    //     // Pass data to the view
    //     return view('layout.result-entry-view', compact('assignedCourse', 'students'));
    // }

    public function resultEntryView($id)
    {
        $user = auth()->user();
        
        // Get the assigned course details for the instructor
        $assignedCourse = Instructor::where('id', $id)->first();
        $admissionYear = $assignedCourse->session1;
        $year = substr($admissionYear, 0, 4);

        // Get the students registered in the course's programme and level for the given academic session
        $students = Registration::where('course', $assignedCourse->programme)
            ->where('class', $assignedCourse->level)
            ->where('admission_year', $year)
            ->get();

        // Get courses for the assigned course details
        $courses = Course::where('course', $assignedCourse->programme)
            ->where('level', $assignedCourse->level)
            ->where('semester', $assignedCourse->semester)
            ->get();

        // Check if result data already exists for these students
        $existingResults = Result::where('course', $assignedCourse->programme)
            ->where('class', $assignedCourse->level)
            ->where('session1', $year)
            ->where('semester', $assignedCourse->semester)
            ->get();

        // If results exist, show the existing data with input fields
        if ($existingResults->isNotEmpty()) {
            $studentScores = [];
            foreach ($existingResults as $result) {
                foreach ($courses as $course) {
                    $courseIndex = $courses->search(function ($item) use ($course) {
                        return $item->course_title === $course->course_title;
                    }) + 1;

                    $studentScores[$result->admission_no][$course->id] = $result->{'score' . $courseIndex} ?? 0;
                }
            }

                return view('layout.result-entry-view', compact('students', 'existingResults', 'assignedCourse', 'courses', 'studentScores'));
            
        } else {
            // If no results, create result entries for all students
            foreach ($students as $student) {
                $resultData = new Result();
                $resultData->admission_no = $student->admission_no;
                $resultData->surname = $student->surname;
                $resultData->first_name = $student->first_name;
                $resultData->other_name = $student->other_name;
                $resultData->semester = $assignedCourse->semester;
                $resultData->course = $assignedCourse->programme;
                $resultData->class = $assignedCourse->level;
                $resultData->session1 = $year;
                $resultData->picture_dir = $student->picture_dir;

                $courseIndex = 1;
                foreach ($courses as $course) {
                    $resultData->{'subject' . $courseIndex} = $course->course_title;
                    $resultData->{'ctitle' . $courseIndex} = $course->course_code;
                    $resultData->{'unit' . $courseIndex} = $course->course_unit;
                    $resultData->{'score' . $courseIndex} = 0; // Default score to 0
                    $courseIndex++;
                }

                $resultData->no_of_course = $courses->count();
                $resultData->save();
            }

                return view('layout.result-entry-view', compact('students', 'courses', 'assignedCourse'));
            
        }
    }

    public function resultEntryAdminView(Request $request)
    {
        $user = auth()->user();
        
        // Get the assigned course details for the instructor
        
        $admissionYear = $request->acad_session;
        $programme = $request->programme;
        $stdLevel = $request->stdLevel;
        $semester = $request->semester;
        $year = substr($admissionYear, 0, 4);

        // Get the students registered in the course's programme and level for the given academic session
        $students = Registration::where('course', $programme)
            ->where('class', $stdLevel)
            ->where('admission_year', $year)
            ->get();

        // Get courses for the assigned course details
        $courses = Course::where('course', $programme)
            ->where('level', $stdLevel)
            ->where('semester', $semester)
            ->get();

        // Check if result data already exists for these students
        $existingResults = Result::where('course', $programme)
            ->where('class', $stdLevel)
            ->where('session1', $year)
            ->where('semester', $semester)
            ->get();

        // If results exist, show the existing data with input fields
        if ($existingResults->isNotEmpty()) {
            $studentScores = [];
            foreach ($existingResults as $result) {
                foreach ($courses as $course) {
                    $courseIndex = $courses->search(function ($item) use ($course) {
                        return $item->course_title === $course->course_title;
                    }) + 1;

                    $studentScores[$result->admission_no][$course->id] = $result->{'score' . $courseIndex} ?? 0;
                }
            }
                        
                return view('layout.result-entry-view-admin', compact('students', 'existingResults', 'courses', 
                'studentScores','programme','admissionYear', 'stdLevel', 'semester'));
            
        } else {
            // If no results, create result entries for all students
            foreach ($students as $student) {
                $resultData = new Result();
                $resultData->admission_no = $student->admission_no;
                $resultData->surname = $student->surname;
                $resultData->first_name = $student->first_name;
                $resultData->other_name = $student->other_name;
                $resultData->semester = $semester;
                $resultData->course = $programme;
                $resultData->class = $stdLevel;
                $resultData->session1 = $year;
                $resultData->picture_dir = $student->picture_dir;

                $courseIndex = 1;
                foreach ($courses as $course) {
                    $resultData->{'subject' . $courseIndex} = $course->course_title;
                    $resultData->{'ctitle' . $courseIndex} = $course->course_code;
                    $resultData->{'unit' . $courseIndex} = $course->course_unit;
                    $resultData->{'score' . $courseIndex} = 0; // Default score to 0
                    $courseIndex++;
                }

                $resultData->no_of_course = $courses->count();
                $resultData->save();
            }

                return view('layout.result-entry-view-admin', compact('students', 'courses','programme',
                'admissionYear', 'stdLevel', 'semester'));
            
        }
    }

    public function saveScore(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_id' => 'required|integer',
                'course_id' => 'required|integer',
                'course_index' => 'required|integer',
                'score' => 'required|numeric|min:0|max:100',
            ]);

            // Log information about the incoming request
            Log::info('Processing score update.', $validated);

            // Find the result entry
            $result = Result::where('admission_no', $request->admission_no)
                ->where('class', $request->class)
                ->where('semester', $request->semester)
                ->first();

            if ($result) {
                $courseIndex = 'score' . $validated['course_index'];
                $result->{$courseIndex} = $validated['score'];
                $result->save();

                // Log::info('Score updated successfully.', [
                //     'result_id' => $result->id,
                //     'course_index' => $courseIndex,
                //     'score' => $validated['score'],
                // ]);

                return response()->json(['message' => 'Score saved successfully.']);
            }

            // Log::warning('Result record not found.', [
            //     'admission_no' => $request->admission_no,
            //     'class' => $request->class,
            //     'semester' => $request->semester,
            // ]);

            return response()->json(['message' => 'Result record not found.'], 404);

        } catch (\Exception $e) {
            Log::error('Error saving score.', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => 'An error occurred.'], 500);
        }
    }


}
