<?php

namespace App\Http\Controllers;
use App\Models\GradingSystem;
use App\Models\Instructor;
use App\Models\Registration;
use App\Models\Result;
use App\Models\ResultCompute;
use App\Models\Course;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\AdministratorControl;
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

    public function resultCompute()
    {
        $user = auth()->user();
        $rolePermission = $user->result_compute;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }
        
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allLevel = StudentLevel::all();

        return view('layout.result-compute', compact('programmes','allLevel'));
    }

    public function resultComputeAction(Request $request)
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
        $semester    = ucfirst(strtolower($validatedData['semester'])); // Normalize to 'First', 'Second', etc.
        $acadSession = $validatedData['acad_session'];
        $programme   = $validatedData['programme'];

        // Define the mapping of level and semester combinations to methods
        $methodMap = [
            '100'  => ['First' => 'firstSemester100',  'Second' => 'secondSemester100'],
            '200'  => ['First' => 'firstSemester200',  'Second' => 'secondSemester200'],
            '300'  => ['First' => 'firstSemester300',  'Second' => 'secondSemester300'],
            'NDI'  => ['First' => 'firstSemesterNDI',  'Second' => 'secondSemesterNDI'],
            'NDII' => ['First' => 'firstSemesterNDII', 'Second' => 'secondSemesterNDII'],
        ];

        // Check if the provided level and semester have a corresponding method
        if (isset($methodMap[$level][$semester])) {
            $method = $methodMap[$level][$semester];
            return $this->$method($acadSession, $programme, $level, $semester, $request);
        }        

        // Handle other cases or return a default response
        return redirect()->back()->with('error', 'Invalid selection made.');
    }

    public function firstSemester100($acadSession, $programme, $level, $semester, Request $request)
    {
        $collegeInfo = AdministratorControl::first();

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can delete and recompute it.');
        }

        // Retrieve student results
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();
        

        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'The result is unavailable at the moment, please enter the results.');
        }

        $grading = GradingSystem::first();

        // Define grading structure
        $grades = [
            ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
            ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
            ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
            ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
            ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
            ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
        ];

        // Initialize studentData
        $studentData = [];

        foreach ($results as $index => $result) {
            $totalPassedCourses = 0;
            $totalFailedCourses = 0;
            $totalCourseUnits = 0;
            $gpaPoints = 0;
            $failedTitles = [];

            // Build student info
            $studentData[$index] = [
                'stuno' => $result->admission_no,
                'stusurname' => $result->surname . ' ' . $result->firstname . ' ' . $result->othername,
                'surname' => $result->surname,
                'firstname' => $result->first_name,
                'othername' => $result->other_name,
                'class' => $result->class,
                'noofcoursekeep' => $result->no_of_course,
                'studpicture' => $result->picture_dir,
                'coursekeep' => $result->course,
                'courses' => [],
            ];

            // Loop through up to 15 courses
            for ($i = 0; $i < 15; $i++) {
                $scoreField = 'score' . ($i + 1);
                $unitField = 'unit' . ($i + 1);
                $titleField = 'ctitle' . ($i + 1);
                $subjectField = 'subject'. ($i + 1);

                $examScore = $result->$scoreField ?? 0;
                $courseUnit = (int) $result->$unitField ?? 0;
                $courseTitle = trim($result->$titleField ?? '');
                $subjectTitle = trim($result->$subjectField ?? '');

                // Save raw scores and titles
                $studentData[$index]['courses'][$i] = [
                    'subjectTitle' => $subjectTitle,
                    'courseTitle' => $courseTitle,
                    'courseUnit' => $courseUnit,
                    'examScore' => $examScore,
                    'grade' => 'F',  // Default grade if score is less than 50
                ];

                if (empty($courseTitle)) {
                    continue;
                }

                $totalCourseUnits += $courseUnit;

                // Grade computation
                $gradeUnit = 0;
                $letter = 'F';
                foreach ($grades as $grade) {
                    if ($examScore >= $grade['min'] && $examScore <= $grade['max']) {
                        $gradeUnit = $grade['unit'];
                        $letter = $grade['letter_grade'];
                        break;
                    }
                }

                if ($examScore >= 50) {
                    $totalPassedCourses++;
                    $gpaPoints += $courseUnit * $gradeUnit;
                } else {
                    if ($examScore > 0) {
                        $failedTitles[] = $courseTitle;
                        $totalFailedCourses++;
                    }
                }

                // Assign grade to the course
                $studentData[$index]['courses'][$i]['grade'] = $letter;
            }

            $studentData[$index]['totalPassed'] = $totalPassedCourses;
            $studentData[$index]['totalFailed'] = $totalFailedCourses;
            $studentData[$index]['totalUnits'] = $totalCourseUnits;
            $studentData[$index]['failedRemarks'] = $failedTitles;
            $studentData[$index]['totalGradePoints'] = $gpaPoints;

            // GPA & Letter Grade
            if ($totalCourseUnits > 0) {
                $gpa = $gpaPoints / $totalCourseUnits;
                $studentData[$index]['totalGPA'] = round($gpa, 2);

                if ($gpa >= $grading->grade51) {
                    $letterGrade = $grading->lgrade6;
                } elseif ($gpa >= $grading->grade41) {
                    $letterGrade = $grading->lgrade5;
                } elseif ($gpa >= $grading->grade31) {
                    $letterGrade = $grading->lgrade4;
                } elseif ($gpa >= $grading->grade21) {
                    $letterGrade = $grading->lgrade3;
                } elseif ($gpa >= $grading->grade11) {
                    $letterGrade = $grading->lgrade2;
                } else {
                    $letterGrade = $grading->lgrade1;
                }

                $studentData[$index]['letterGrade'] = $letterGrade;
            }

            $studentData[$index]['remarks'] = $totalFailedCourses > 0 ? 'HAS CARRYOVER' : 'PASSED ALL';
        }

        // Paginate and get current student data
        $page = $request->query('page', 1);  // Get the current page or default to page 1
        $resultsPerPage = 1;  // This can be adjusted depending on how many results you want per page

        $paginatedResults = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->paginate($resultsPerPage);

        $total = $paginatedResults->total(); // Get the total number of records

        // Now pass the paginated results to the view
        return view('results.student_result_page', [
            'studentData' => $studentData,
            'page' => $page,
            'total' => $total,
            'collegeInfo' => $collegeInfo,
            'semester' => $semester,
            'level' => $level,
            'programme' => $programme,
            'acadSession' => $acadSession,
            'results' => $paginatedResults,
            'gradingSystem' => $grading,
            'grades' => $grades,
        ]);
    }


}
