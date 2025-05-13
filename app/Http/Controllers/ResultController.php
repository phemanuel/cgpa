<?php

namespace App\Http\Controllers;
use App\Models\GradingSystem;
use App\Models\Instructor;
use App\Models\Registration;
use App\Models\Result;
use App\Models\ResultCompute;
use App\Models\Course;
use App\Models\CourseStudy;
use App\Models\CourseStudyAll;
use App\Models\StudentLevel;
use App\Models\AdministratorControl;
use App\Models\hod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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
            // ->where('class', $assignedCourse->level)
            ->where('admission_year', $year)
            ->get();
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No students found for the selected programme, level, and academic session.');
        }

        // Get courses for the assigned course details
        $courses = Course::where('course', $assignedCourse->programme)
            ->where('level', $assignedCourse->level)
            ->where('semester', $assignedCourse->semester)
            ->get();

        // Get existing results
        $existingResults = Result::where('course', $assignedCourse->programme)
            ->where('class', $assignedCourse->level)
            ->where('session1', $year)
            ->where('semester', $assignedCourse->semester)
            ->get();

        // Get admission numbers of students who already have results
        $existingAdmissionNos = $existingResults->pluck('admission_no')->toArray();

        // Create results for only students without result records
        $newStudents = $students->filter(function ($student) use ($existingAdmissionNos) {
            return !in_array($student->admission_no, $existingAdmissionNos);
        });

        foreach ($newStudents as $student) {
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
                $resultData->{'score' . $courseIndex} = 0;
                $courseIndex++;
            }

            $resultData->no_of_course = $courses->count();
            $resultData->save();
        }

        // Re-fetch updated results if new ones were added
        $updatedResults = Result::where('course', $assignedCourse->programme)
            ->where('class', $assignedCourse->level)
            ->where('session1', $year)
            ->where('semester', $assignedCourse->semester)
            ->get();

        // Prepare student scores
        $studentScores = [];
        foreach ($updatedResults as $result) {
            foreach ($courses as $course) {
                $courseIndex = $courses->search(function ($item) use ($course) {
                    return $item->course_title === $course->course_title;
                }) + 1;

                $studentScores[$result->admission_no][$course->id] = $result->{'score' . $courseIndex} ?? 0;
            }
        }
        $stdLevel = $assignedCourse->level;
        $semester = $assignedCourse->semester;

        return view('layout.result-entry-view', compact(
            'students', 'updatedResults', 'assignedCourse', 'courses', 'studentScores', 'stdLevel', 'semester'
        ));
    }

    private function getPreviousLevelAndSemester($stdLevel, $semester)
    {
        $levelOrder = ['NDI', 'NDII', 'HNDI', 'HNDII', '100', '200', '300'];
        $currentIndex = array_search($stdLevel, $levelOrder);

        if ($semester === 'First') {
            // If it's the First semester, go back to previous level's Second semester
            $prevSemester = 'Second';
            $prevLevel = $currentIndex > 0 ? $levelOrder[$currentIndex - 1] : null;
        } else {
            // If it's Second semester, previous semester is First of the same level
            $prevSemester = 'First';
            $prevLevel = $stdLevel;
        }

        return [$prevLevel, $prevSemester];
    }


    public function resultEntryAdminView(Request $request)
    {
        $user = auth()->user();

        // Validate incoming parameters
    $validated = $request->validate([
        'acad_session' => 'required',
        'programme' => 'required|string|exists:course_study_all,department',
        'stdLevel' => 'required|string|in:100,200,300,NDI,NDII,HNDI,HNDII',
        'semester' => 'required',
    ]);

    $admissionYear = $validated['acad_session'];
    $programme = $validated['programme'];
    $stdLevel = $validated['stdLevel'];
    $semester = $validated['semester'];

    // Get the curriculum courses for the current level and semester
    $curriculumCourses = Course::where('course', $programme)
        ->where('level', $stdLevel)
        ->where('semester', $semester)
        ->get();

    $totalCourses = $curriculumCourses->count(); // Total number of courses for this level and semester

    // Proceed with the rest of the logic
    $students = Registration::where('course', $programme)
        ->where('admission_year', $admissionYear)
        ->get();

    if ($students->isEmpty()) {
        return redirect()->back()->with('error', 'No students found for the selected programme, level, and academic session.');
    }   

    $studentsWithFailedCourses = []; // Array to store students with failed courses

    foreach ($students as $student) {
    // Get the previous level and semester using the new function
    list($previousLevel, $previousSemester) = $this->getPreviousLevelAndSemester($stdLevel, $semester);   

    // Check if student has failed courses
    $failedCourses = DB::table('result_computes')
        ->where('admission_no', $student->admission_no)
        ->where('class', $previousLevel)
        ->where('semester', $previousSemester)
        ->where('session1', $admissionYear)
        ->first();
        
        if ($failedCourses && !empty($failedCourses->failed_course)) {
            // Add student to the failed courses array
            $failedCoursesList = array_map('trim', explode(',', $failedCourses->failed_course));
            $studentsWithFailedCourses[$student->admission_no] = $failedCoursesList;      

            // Log the student's failed courses
            // Log::info("Student {$student->admission_no} has failed the following courses: " . implode(', ', $failedCoursesList));
        } else {
            // Log::info("No failed courses found for student {$student->admission_no}");
        }
    }

    $existingResults = Result::where('course', $programme)
        ->where('class', $stdLevel)
        ->where('session1', $admissionYear)
        ->where('semester', $semester)
        ->get();

    // New result entry creation for students without results
    $existingAdmissionNumbers = $existingResults->pluck('admission_no')->toArray();
    foreach ($students as $student) {
        if (!in_array($student->admission_no, $existingAdmissionNumbers)) {
            $resultData = new Result();
            $resultData->admission_no = $student->admission_no;
            $resultData->surname = $student->surname;
            $resultData->first_name = $student->first_name;
            $resultData->other_name = $student->other_name;
            $resultData->semester = $semester;
            $resultData->course = $programme;
            $resultData->class = $stdLevel;
            $resultData->session1 = $admissionYear;
            $resultData->picture_dir = $student->picture_dir;

            $courseIndex = 1;

            // Add curriculum courses
            foreach ($curriculumCourses as $course) {
                $resultData->{'subject' . $courseIndex} = $course->course_title;
                $resultData->{'ctitle' . $courseIndex} = $course->course_code;
                $resultData->{'unit' . $courseIndex} = $course->course_unit;
                $resultData->{'score' . $courseIndex} = 0;
                $courseIndex++;
            }

            $resultData->no_of_course = $courseIndex - 1;
            $resultData->save();

            $existingResults->push($resultData);
        }
    }

    // Compile the list of courses and student scores
    $currentCourses = collect();
    $maxSubjects = 0;

    foreach ($existingResults as $result) {
        for ($i = 1; $i <= $totalCourses; $i++) {
            $subject = $result->{'subject' . $i} ?? null;
            $ctitle = $result->{'ctitle' . $i} ?? null;
            $unit = $result->{'unit' . $i} ?? null;

            if ($subject && $ctitle !== 'REPEAT') {
                $maxSubjects = max($maxSubjects, $i);
                $currentCourses->push((object)[
                    'course_title' => $subject,
                    'course_code' => $ctitle,
                    'course_unit' => $unit,
                    'index' => $i,
                    'is_failed' => false,
                ]);
            }
        }
    }

    $currentCourses = $currentCourses->unique('course_code')->values();
    $studentScores = [];
    foreach ($existingResults as $result) {
        for ($i = 1; $i <= $maxSubjects; $i++) {
            $studentScores[$result->admission_no][$i] = $result->{'score' . $i} ?? 0;
        }
    }

    $courses = $currentCourses;

    // Pass failed courses data to the view
    return view('layout.result-entry-view-admin', compact(
        'students', 'existingResults', 'courses', 'studentScores',
        'programme', 'admissionYear', 'stdLevel', 'semester', 'totalCourses', 'studentsWithFailedCourses',
        'admissionYear'
    ));     
        

        // === 10. Create result entry for all (first-time) ===
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

            foreach ($curriculumCourses as $course) {
                $resultData->{'subject' . $courseIndex} = $course->course_title;
                $resultData->{'ctitle' . $courseIndex} = $course->course_code;
                $resultData->{'unit' . $courseIndex} = $course->course_unit;
                $resultData->{'score' . $courseIndex} = 0;
                $courseIndex++;
            }

            if (isset($studentsWithFailedCourses[$student->admission_no])) {
                foreach ($studentsWithFailedCourses[$student->admission_no] as $failedCourseTitle) {
                    $resultData->{'subject' . $courseIndex} = $failedCourseTitle;
                    $resultData->{'ctitle' . $courseIndex} = 'REPEAT';
                    $resultData->{'unit' . $courseIndex} = 0;
                    $resultData->{'score' . $courseIndex} = 0;
                    $courseIndex++;
                }
            }

            $resultData->no_of_course = $courseIndex - 1;
            $resultData->save();
        }

        // Final course list to display
        $courses = $curriculumCourses;

        return view('layout.result-entry-view-admin', compact(
            'students', 'courses', 'programme', 'admissionYear', 'stdLevel', 'semester'
        ));
    }

    private function getPreviousLevel($currentLevel)
    {
        $map = [
            '100' => null,
            'NDI' => null,
            '200' => '100',
            'NDII' => 'NDI',
            '300' => '200',
            'HNDI' => 'null',
            'HNDII' => 'HNDI',
        ];

        return $map[$currentLevel] ?? null;
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

            

                return response()->json(['message' => 'Score saved successfully.']);
            }            

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

        $courseStudy = CourseStudy::where('dept_name', $validatedData['programme'])->first();
        $courseDuration = $courseStudy->dept_duration;

        if($courseDuration == 2){
            // Define the mapping of level and semester combinations to methods
            $methodMap = [
                '100'  => ['First' => 'firstSemester100',  'Second' => 'secondSemester100'],
                '200'  => ['First' => 'firstSemester300',  'Second' => 'secondSemester300'],                
                'NDI'  => ['First' => 'firstSemester100',  'Second' => 'secondSemester100'],
                'NDII' => ['First' => 'firstSemester300', 'Second' => 'secondSemester300'],
            ];
        }
        elseif($courseDuration == 3){
            // Define the mapping of level and semester combinations to methods
            $methodMap = [
                '100'  => ['First' => 'firstSemester100',  'Second' => 'secondSemester100'],
                '200'  => ['First' => 'firstSemester200',  'Second' => 'secondSemester200'],
                '300'  => ['First' => 'firstSemester300',  'Second' => 'secondSemester300'],
                'NDI'  => ['First' => 'firstSemester100',  'Second' => 'secondSemester100'],
                'NDII' => ['First' => 'firstSemester300', 'Second' => 'secondSemester300'],
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
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        // Retrieve student results
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();
        

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
        //---save results to db-----
        foreach ($studentData as $index => $data) {
            $compute = new \App\Models\ResultCompute();
        
            $compute->admission_no = $data['stuno'] ?? '';
            $compute->surname = $data['surname'] ?? '';
            $compute->first_name = $data['firstname'] ?? '';
            $compute->other_name = $data['othername'] ?? '';
            $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
            $compute->class = $data['class'] ?? '';
            $compute->semester = $semester;
            $compute->session1 = $acadSession;
            $compute->course = $data['coursekeep'] ?? '';
            $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
            $compute->picture_dir = $data['studpicture'] ?? '';
            $compute->gpa = $data['totalGPA'] ?? 0;
            $compute->total_grade_point = $data['totalGradePoints'] ?? 0;
            $compute->total_course_unit = $data['totalUnits'] ?? 0;
            $compute->total_failed_course = $data['totalFailed'] ?? 0;
            $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
            $compute->remark = $data['remarks'] ?? 'PASSED ALL';
        
            if (!empty($data['courses'])) {
                foreach ($data['courses'] as $i => $course) {
                    $col = $i + 1;
                    if ($col > 19) break;
        
                    $unit = $course['courseUnit'] ?? 0;
                    $score = $course['examScore'] ?? 0;
                    $gradePoint = 0;
                    $letterGrade = 'F';
        
                    // Determine grade and point based on grading scheme
                    foreach ($grades as $grade) {
                        if ($score >= $grade['min'] && $score <= $grade['max']) {
                            $gradePoint = $grade['unit'];
                            $letterGrade = $grade['letter_grade'];
                            break;
                        }
                    }
        
                    $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                    $compute["score{$col}"] = $score;
                    $compute["unit{$col}"] = $unit;
                    $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                    $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                    $compute["ctotal{$col}"] = $unit * $gradePoint;
                }
            }
        
            if (!empty($data['failedRemarks'])) {
                foreach ($data['failedRemarks'] as $i => $fail) {
                    if ($i < 15) {
                        $compute["carryover" . ($i + 1)] = $fail;
                    }
                }
            }
            $compute->sn = $index + 1;
            $compute->save();  

        }
        return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
        
    }

    public function secondSemester100($acadSession, $programme, $level, $semester, Request $request)
    {
        $collegeInfo = AdministratorControl::first();

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        //--Get the GPA for the first semester------
        $stdGpaFirst = ResultCompute::where('semester', 'First')
        ->where('class', $level)
        ->where('session1', $acadSession)
        ->where('course', $programme)
        ->get();

        if ($stdGpaFirst->isEmpty()) {
            return redirect()->back()->with('error', 'The First semester results are not available.');
        }

        // Retrieve student results for second semester
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();

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
        $firstSemesterData = [];

        foreach ($stdGpaFirst as $firstIndex => $firstResult) {
            $firstSemesterData[$firstIndex] = [
                'gpa' => $firstResult->gpa,
                'totalFailedCourses' => $firstResult->total_failed_course,
                'totalCourseUnits' => $firstResult->total_course_unit,
                'totalGradePoints' => $firstResult->total_grade_point
            ];
        }

        // Loop through second semester results and calculate
        foreach ($results as $index => $result) {
            $totalPassedCourses = 0;
            $totalFailedCourses = 0;
            $totalCourseUnits = 0;
            $gpaPoints = 0;
            $failedTitles = [];

            // Build student info for second semester
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

            // Loop through up to 15 courses for second semester
            for ($i = 0; $i < 15; $i++) {
                $scoreField = 'score' . ($i + 1);
                $unitField = 'unit' . ($i + 1);
                $titleField = 'ctitle' . ($i + 1);
                $subjectField = 'subject'. ($i + 1);

                $examScore = $result->$scoreField ?? 0;
                $courseUnit = (int) $result->$unitField ?? 0;
                $courseTitle = trim($result->$titleField ?? '');
                $subjectTitle = trim($result->$subjectField ?? '');

                // Save raw scores and titles for second semester
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

                // Assign grade to the course for second semester
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

            // Calculate CGPA, all totals, and remarks
            $gpaFirst = $firstSemesterData[$index]['gpa']; // Correct reference to first semester GPA
            $totalFailedCoursesCombined = $totalFailedCourses + $firstSemesterData[$index]['totalFailedCourses'];
            $totalCourseUnitsCombined = $totalCourseUnits + $firstSemesterData[$index]['totalCourseUnits'];
            $totalGradePointsCombined = $gpaPoints + $firstSemesterData[$index]['totalGradePoints'];

            $combinedGPA = ($gpaFirst + $gpa) / 2;
            // $combinedGPA = ($totalGradePointsCombined / $totalCourseUnitsCombined);
            $combinedRemark = $combinedGPA < 1.5 ? 'Advised to withdraw' : ($totalFailedCoursesCombined > 3 ? 'Repeat' : 'No Remark');

            $studentData[$index]['combinedGPA'] = $combinedGPA;  // Store combined GPA in studentData
            $studentData[$index]['combinedRemark'] = $combinedRemark;  // Store combined remark

            foreach ($studentData as $index => $data) {
                $compute = new \App\Models\ResultCompute();
                
                // Check if the record already exists for this student and semester
                $existingRecord = ResultCompute::where('admission_no', $data['stuno'])
                                               ->where('semester', $semester)
                                               ->where('session1', $acadSession)
                                               ->where('class', $level)
                                               ->exists();
                
                if ($existingRecord) {
                    // Skip saving this student's data to avoid duplicates
                    continue; // Or update the existing record if necessary, e.g., $compute->update([...]);
                }
                
                // Store student details
                $compute->admission_no = $data['stuno'] ?? '';
                $compute->surname = $data['surname'] ?? '';
                $compute->first_name = $data['firstname'] ?? '';
                $compute->other_name = $data['othername'] ?? '';
                $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
                $compute->class = $data['class'] ?? '';
                $compute->semester = $semester;
                $compute->session1 = $acadSession;
                $compute->course = $data['coursekeep'] ?? '';
                $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
                $compute->picture_dir = $data['studpicture'] ?? '';
                $compute->total_course_unit = ($data['totalUnits'] ?? 0);
                $compute->total_grade_point = ($data['totalGradePoints'] ?? 0);
                $compute->total_failed_course = ($data['totalFailed'] ?? 0);
                
                // Store GPAs and CGPA
                $compute->gpa1 = $firstSemesterData[$index]['gpa']; // First semester GPA
                $compute->gpa  = $data['totalGPA']; // Second semester GPA
                $compute->gpa2 = $data['totalGPA']; // Second semester GPA
                $compute->cgpa = number_format(($totalGradePointsCombined / $totalCourseUnitsCombined), 2); // Combined CGPA
                
                // Store combined data for both semesters
                $compute->all_total_failed_course = $totalFailedCoursesCombined; // Total failed courses across both semesters
                $compute->all_total_course_unit = $totalCourseUnitsCombined; // Total course units across both semesters
                $compute->all_total_grade_point = $totalGradePointsCombined; // Total grade points across both semesters
                
                // Store failed course remarks
                $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
                $compute->remark = $data['remarks'] ?? 'PASSED ALL';
                $compute->total_remark = $data['combinedRemark'] ?? 'PASSED ALL';
                
                // Store courses and grades
                if (!empty($data['courses'])) {
                    foreach ($data['courses'] as $i => $course) {
                        $col = $i + 1;
                        if ($col > 19) break; // Limit to 19 subjects
            
                        $unit = $course['courseUnit'] ?? 0;
                        $score = $course['examScore'] ?? 0;
                        $gradePoint = 0;
                        $letterGrade = 'F';
            
                        // Determine grade and point based on grading scheme
                        foreach ($grades as $grade) {
                            if ($score >= $grade['min'] && $score <= $grade['max']) {
                                $gradePoint = $grade['unit'];
                                $letterGrade = $grade['letter_grade'];
                                break;
                            }
                        }
            
                        // Store individual course data
                        $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                        $compute["score{$col}"] = $score;
                        $compute["unit{$col}"] = $unit;
                        $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                        $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                        $compute["ctotal{$col}"] = $unit * $gradePoint;
                    }
                }
                
                // Store failed courses
                if (!empty($data['failedRemarks'])) {
                    foreach ($data['failedRemarks'] as $i => $fail) {
                        if ($i < 15) {
                            $compute["carryover" . ($i + 1)] = $fail;
                        }
                    }
                }
                
                // Store serial number (index) and save the record
                $compute->sn = $index + 1;
                $compute->save();
            }
        }

        return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
    }

    public function firstSemester200($acadSession, $programme, $level, $semester, Request $request)
    {
        $collegeInfo = AdministratorControl::first();

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        // Retrieve student results
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();
        

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
        //---save results to db-----
        foreach ($studentData as $index => $data) {
            $compute = new \App\Models\ResultCompute();
        
            $compute->admission_no = $data['stuno'] ?? '';
            $compute->surname = $data['surname'] ?? '';
            $compute->first_name = $data['firstname'] ?? '';
            $compute->other_name = $data['othername'] ?? '';
            $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
            $compute->class = $data['class'] ?? '';
            $compute->semester = $semester;
            $compute->session1 = $acadSession;
            $compute->course = $data['coursekeep'] ?? '';
            $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
            $compute->picture_dir = $data['studpicture'] ?? '';
            $compute->gpa = $data['totalGPA'] ?? 0;
            $compute->total_grade_point = $data['totalGradePoints'] ?? 0;
            $compute->total_course_unit = $data['totalUnits'] ?? 0;
            $compute->total_failed_course = $data['totalFailed'] ?? 0;
            $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
            $compute->remark = $data['remarks'] ?? 'PASSED ALL';
        
            if (!empty($data['courses'])) {
                foreach ($data['courses'] as $i => $course) {
                    $col = $i + 1;
                    if ($col > 19) break;
        
                    $unit = $course['courseUnit'] ?? 0;
                    $score = $course['examScore'] ?? 0;
                    $gradePoint = 0;
                    $letterGrade = 'F';
        
                    // Determine grade and point based on grading scheme
                    foreach ($grades as $grade) {
                        if ($score >= $grade['min'] && $score <= $grade['max']) {
                            $gradePoint = $grade['unit'];
                            $letterGrade = $grade['letter_grade'];
                            break;
                        }
                    }
        
                    $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                    $compute["score{$col}"] = $score;
                    $compute["unit{$col}"] = $unit;
                    $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                    $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                    $compute["ctotal{$col}"] = $unit * $gradePoint;
                }
            }
        
            if (!empty($data['failedRemarks'])) {
                foreach ($data['failedRemarks'] as $i => $fail) {
                    if ($i < 15) {
                        $compute["carryover" . ($i + 1)] = $fail;
                    }
                }
            }
            $compute->sn = $index + 1;
            $compute->save();  

        }
        return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
        
    }

    public function secondSemester200($acadSession, $programme, $level, $semester, Request $request)
    {
        Log::info('Starting result computation...');
        $collegeInfo = AdministratorControl::first();

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        //--Get the GPA for the first semester------
        $stdGpaFirst = ResultCompute::where('semester', 'First')
        ->where('class', $level)
        ->where('session1', $acadSession)
        ->where('course', $programme)
        ->get();

        if ($stdGpaFirst->isEmpty()) {
            return redirect()->back()->with('error', 'The First semester results are not available.');
        }

        // Retrieve student results for second semester
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();

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
        $firstSemesterData = [];

        foreach ($stdGpaFirst as $firstIndex => $firstResult) {
            $firstSemesterData[$firstIndex] = [
                'gpa' => $firstResult->gpa,
                'totalFailedCourses' => $firstResult->total_failed_course,
                'totalCourseUnits' => $firstResult->total_course_unit,
                'totalGradePoints' => $firstResult->total_grade_point
            ];
        }

        // Loop through second semester results and calculate
        foreach ($results as $index => $result) {
            $totalPassedCourses = 0;
            $totalFailedCourses = 0;
            $totalCourseUnits = 0;
            $gpaPoints = 0;
            $failedTitles = [];

            // Build student info for second semester
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

            // Loop through up to 15 courses for second semester
            for ($i = 0; $i < 15; $i++) {
                $scoreField = 'score' . ($i + 1);
                $unitField = 'unit' . ($i + 1);
                $titleField = 'ctitle' . ($i + 1);
                $subjectField = 'subject'. ($i + 1);

                $examScore = $result->$scoreField ?? 0;
                $courseUnit = (int) $result->$unitField ?? 0;
                $courseTitle = trim($result->$titleField ?? '');
                $subjectTitle = trim($result->$subjectField ?? '');

                // Save raw scores and titles for second semester
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

                // Assign grade to the course for second semester
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

            // Calculate CGPA, all totals, and remarks
            $gpaFirst = $firstSemesterData[$index]['gpa']; // Correct reference to first semester GPA
            $totalFailedCoursesCombined = $totalFailedCourses + $firstSemesterData[$index]['totalFailedCourses'];
            $totalCourseUnitsCombined = $totalCourseUnits + $firstSemesterData[$index]['totalCourseUnits'];
            $totalGradePointsCombined = $gpaPoints + $firstSemesterData[$index]['totalGradePoints'];

            $combinedGPA = ($gpaFirst + $gpa) / 2;
            $combinedRemark = $combinedGPA < 1.5 ? 'Advised to withdraw' : ($totalFailedCoursesCombined > 3 ? 'Repeat' : 'No Remark');

            $studentData[$index]['combinedGPA'] = $combinedGPA;  // Store combined GPA in studentData
            $studentData[$index]['combinedRemark'] = $combinedRemark;  // Store combined remark

            foreach ($studentData as $index => $data) {
                $compute = new \App\Models\ResultCompute();
                
                // Check if the record already exists for this student and semester
                $existingRecord = ResultCompute::where('admission_no', $data['stuno'])
                                               ->where('semester', $semester)
                                               ->where('session1', $acadSession)
                                               ->where('class', $level)
                                               ->exists();
                
                if ($existingRecord) {
                    // Skip saving this student's data to avoid duplicates
                    continue; // Or update the existing record if necessary, e.g., $compute->update([...]);
                }
                
                // Store student details
                $compute->admission_no = $data['stuno'] ?? '';
                $compute->surname = $data['surname'] ?? '';
                $compute->first_name = $data['firstname'] ?? '';
                $compute->other_name = $data['othername'] ?? '';
                $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
                $compute->class = $data['class'] ?? '';
                $compute->semester = $semester;
                $compute->session1 = $acadSession;
                $compute->course = $data['coursekeep'] ?? '';
                $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
                $compute->picture_dir = $data['studpicture'] ?? '';
                $compute->total_course_unit = ($data['totalUnits'] ?? 0);
                $compute->total_grade_point = ($data['totalGradePoints'] ?? 0);
                $compute->total_failed_course = ($data['totalFailed'] ?? 0);
                
                // Store GPAs and CGPA
                $compute->gpa1 = $firstSemesterData[$index]['gpa']; // First semester GPA
                $compute->gpa  = $data['totalGPA']; // Second semester GPA
                $compute->gpa2 = $data['totalGPA']; // Second semester GPA
                // $compute->cgpa = round(($data['totalGPA'] + $firstSemesterData[$index]['gpa']) / 2, 2); // Combined CGPA
                $compute->cgpa = number_format(($totalGradePointsCombined / $totalCourseUnitsCombined), 2);
                // Store combined data for both semesters
                $compute->all_total_failed_course = $totalFailedCoursesCombined; // Total failed courses across both semesters
                $compute->all_total_course_unit = $totalCourseUnitsCombined; // Total course units across both semesters
                $compute->all_total_grade_point = $totalGradePointsCombined; // Total grade points across both semesters
                
                // Store failed course remarks
                $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
                $compute->remark = $data['remarks'] ?? 'PASSED ALL';
                $compute->total_remark = $data['combinedRemark'] ?? 'PASSED ALL';
                
                // Store courses and grades
                if (!empty($data['courses'])) {
                    foreach ($data['courses'] as $i => $course) {
                        $col = $i + 1;
                        if ($col > 19) break; // Limit to 19 subjects
            
                        $unit = $course['courseUnit'] ?? 0;
                        $score = $course['examScore'] ?? 0;
                        $gradePoint = 0;
                        $letterGrade = 'F';
            
                        // Determine grade and point based on grading scheme
                        foreach ($grades as $grade) {
                            if ($score >= $grade['min'] && $score <= $grade['max']) {
                                $gradePoint = $grade['unit'];
                                $letterGrade = $grade['letter_grade'];
                                break;
                            }
                        }
            
                        // Store individual course data
                        $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                        $compute["score{$col}"] = $score;
                        $compute["unit{$col}"] = $unit;
                        $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                        $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                        $compute["ctotal{$col}"] = $unit * $gradePoint;
                    }
                }
                
                // Store failed courses
                if (!empty($data['failedRemarks'])) {
                    foreach ($data['failedRemarks'] as $i => $fail) {
                        if ($i < 15) {
                            $compute["carryover" . ($i + 1)] = $fail;
                        }
                    }
                }
                
                // Store serial number (index) and save the record
                $compute->sn = $index + 1;
                $compute->save();
            }
        }

        return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
    }

    public function firstSemester300($acadSession, $programme, $level, $semester, Request $request)
    {
        $collegeInfo = AdministratorControl::first();

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        // Retrieve student results
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();
        

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
        //---save results to db-----
        foreach ($studentData as $index => $data) {
            $compute = new \App\Models\ResultCompute();
        
            $compute->admission_no = $data['stuno'] ?? '';
            $compute->surname = $data['surname'] ?? '';
            $compute->first_name = $data['firstname'] ?? '';
            $compute->other_name = $data['othername'] ?? '';
            $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
            $compute->class = $data['class'] ?? '';
            $compute->semester = $semester;
            $compute->session1 = $acadSession;
            $compute->course = $data['coursekeep'] ?? '';
            $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
            $compute->picture_dir = $data['studpicture'] ?? '';
            $compute->gpa = $data['totalGPA'] ?? 0;
            $compute->total_grade_point = $data['totalGradePoints'] ?? 0;
            $compute->total_course_unit = $data['totalUnits'] ?? 0;
            $compute->total_failed_course = $data['totalFailed'] ?? 0;
            $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
            $compute->remark = $data['remarks'] ?? 'PASSED ALL';
        
            if (!empty($data['courses'])) {
                foreach ($data['courses'] as $i => $course) {
                    $col = $i + 1;
                    if ($col > 19) break;
        
                    $unit = $course['courseUnit'] ?? 0;
                    $score = $course['examScore'] ?? 0;
                    $gradePoint = 0;
                    $letterGrade = 'F';
        
                    // Determine grade and point based on grading scheme
                    foreach ($grades as $grade) {
                        if ($score >= $grade['min'] && $score <= $grade['max']) {
                            $gradePoint = $grade['unit'];
                            $letterGrade = $grade['letter_grade'];
                            break;
                        }
                    }
        
                    $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                    $compute["score{$col}"] = $score;
                    $compute["unit{$col}"] = $unit;
                    $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                    $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                    $compute["ctotal{$col}"] = $unit * $gradePoint;
                }
            }
        
            if (!empty($data['failedRemarks'])) {
                foreach ($data['failedRemarks'] as $i => $fail) {
                    if ($i < 15) {
                        $compute["carryover" . ($i + 1)] = $fail;
                    }
                }
            }
            $compute->sn = $index + 1;
            $compute->save();  

        }
        return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
        
    }

    public function secondSemester300($acadSession, $programme, $level, $semester, Request $request)
    {
        // Log::info('Starting result computation...');
        $collegeInfo = AdministratorControl::first();
        $courseStudy = CourseStudy::where('dept_name', $programme)->first();
        $courseDuration = $courseStudy->dept_duration;

        // Check if result already computed
        $resultComputeExists = ResultCompute::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->exists();

        if ($resultComputeExists) {
            return redirect()->back()->with('error', 'The result has been computed already. You can either preview, or delete and recompute.');
        }

        //--Get the GPA for the first semester------
        $stdGpaFirst = ResultCompute::where('semester', 'First')
        ->where('class', $level)
        ->where('session1', $acadSession)
        ->where('course', $programme)
        ->get();

        if ($stdGpaFirst->isEmpty()) {
            return redirect()->back()->with('error', 'The First semester results are not available.');
        }

        // Retrieve student results for second semester
        $results = Result::where('semester', $semester)
            ->where('class', $level)
            ->where('session1', $acadSession)
            ->where('course', $programme)
            ->get();

        $totalStudent  = $results->count();

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
        $firstSemesterData = [];

        foreach ($stdGpaFirst as $firstIndex => $firstResult) {
            $firstSemesterData[$firstIndex] = [
                'gpa' => $firstResult->gpa,
                'totalFailedCourses' => $firstResult->total_failed_course,
                'totalCourseUnits' => $firstResult->total_course_unit,
                'totalGradePoints' => $firstResult->total_grade_point
            ];
        }

        // Loop through second semester results and calculate
        foreach ($results as $index => $result) {
            $totalPassedCourses = 0;
            $totalFailedCourses = 0;
            $totalCourseUnits = 0;
            $gpaPoints = 0;
            $failedTitles = [];

            // Build student info for second semester
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

            // Loop through up to 15 courses for second semester
            for ($i = 0; $i < 15; $i++) {
                $scoreField = 'score' . ($i + 1);
                $unitField = 'unit' . ($i + 1);
                $titleField = 'ctitle' . ($i + 1);
                $subjectField = 'subject'. ($i + 1);

                $examScore = $result->$scoreField ?? 0;
                $courseUnit = (int) $result->$unitField ?? 0;
                $courseTitle = trim($result->$titleField ?? '');
                $subjectTitle = trim($result->$subjectField ?? '');

                // Save raw scores and titles for second semester
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

                // Assign grade to the course for second semester
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

            // Calculate CGPA, all totals, and remarks
            $gpaFirst = $firstSemesterData[$index]['gpa']; // Correct reference to first semester GPA
            $totalFailedCoursesCombined = $totalFailedCourses + $firstSemesterData[$index]['totalFailedCourses'];
            $totalCourseUnitsCombined = $totalCourseUnits + $firstSemesterData[$index]['totalCourseUnits'];
            $totalGradePointsCombined = $gpaPoints + $firstSemesterData[$index]['totalGradePoints'];

            $combinedGPA = ($gpaFirst + $gpa) / 2;
            $combinedRemark = $combinedGPA < 1.5 ? 'Advised to withdraw' : ($totalFailedCoursesCombined > 3 ? 'Repeat' : 'No Remark');

            $studentData[$index]['combinedGPA'] = $combinedGPA;  // Store combined GPA in studentData
            $studentData[$index]['combinedRemark'] = $combinedRemark;  // Store combined remark

            foreach ($studentData as $index => $data) {
                $compute = new \App\Models\ResultCompute();
                
                // Check if the record already exists for this student and semester
                $existingRecord = ResultCompute::where('admission_no', $data['stuno'])
                                               ->where('semester', $semester)
                                               ->where('session1', $acadSession)
                                               ->where('class', $level)
                                               ->exists();
                
                if ($existingRecord) {
                    // Skip saving this student's data to avoid duplicates
                    continue; // Or update the existing record if necessary, e.g., $compute->update([...]);
                }
                
                // Store student details
                $compute->admission_no = $data['stuno'] ?? '';
                $compute->surname = $data['surname'] ?? '';
                $compute->first_name = $data['firstname'] ?? '';
                $compute->other_name = $data['othername'] ?? '';
                $compute->student_full_name = $data['surname'] . ' ' . $data['firstname'] . ' ' . $data['othername'];
                $compute->class = $data['class'] ?? '';
                $compute->semester = $semester;
                $compute->session1 = $acadSession;
                $compute->course = $data['coursekeep'] ?? '';
                $compute->no_of_course = $data['noofcoursekeep'] ?? 0;
                $compute->picture_dir = $data['studpicture'] ?? '';
                $compute->total_course_unit = ($data['totalUnits'] ?? 0);
                $compute->total_grade_point = ($data['totalGradePoints'] ?? 0);
                $compute->total_failed_course = ($data['totalFailed'] ?? 0);
                
                // Store GPAs and CGPA
                $compute->gpa1 = $firstSemesterData[$index]['gpa']; // First semester GPA
                $compute->gpa  = $data['totalGPA']; // Second semester GPA
                $compute->gpa2 = $data['totalGPA']; // Second semester GPA
                // $compute->cgpa = round(($data['totalGPA'] + $firstSemesterData[$index]['gpa']) / 2, 2); // Combined CGPA
                $compute->cgpa = number_format(($totalGradePointsCombined / $totalCourseUnitsCombined), 2);
                
                // Store combined data for both semesters
                $compute->all_total_failed_course = $totalFailedCoursesCombined; // Total failed courses across both semesters
                $compute->all_total_course_unit = $totalCourseUnitsCombined; // Total course units across both semesters
                $compute->all_total_grade_point = $totalGradePointsCombined; // Total grade points across both semesters
                
                // Store failed course remarks
                $compute->failed_course = !empty($data['failedRemarks']) ? implode(', ', $data['failedRemarks']) : '';
                $compute->remark = $data['remarks'] ?? 'PASSED ALL';
                $compute->total_remark = $data['combinedRemark'] ?? 'PASSED ALL';
                
                // Store courses and grades
                if (!empty($data['courses'])) {
                    foreach ($data['courses'] as $i => $course) {
                        $col = $i + 1;
                        if ($col > 19) break; // Limit to 19 subjects
            
                        $unit = $course['courseUnit'] ?? 0;
                        $score = $course['examScore'] ?? 0;
                        $gradePoint = 0;
                        $letterGrade = 'F';
            
                        // Determine grade and point based on grading scheme
                        foreach ($grades as $grade) {
                            if ($score >= $grade['min'] && $score <= $grade['max']) {
                                $gradePoint = $grade['unit'];
                                $letterGrade = $grade['letter_grade'];
                                break;
                            }
                        }
            
                        // Store individual course data
                        $compute["subject{$col}"] = $course['subjectTitle'] ?? '';
                        $compute["score{$col}"] = $score;
                        $compute["unit{$col}"] = $unit;
                        $compute["subjectgrade{$col}"] = $letterGrade ?? '';
                        $compute["ctitle{$col}"] = $course['courseTitle'] ?? '';
                        $compute["ctotal{$col}"] = $unit * $gradePoint;
                    }
                }
                
                // Store failed courses
                if (!empty($data['failedRemarks'])) {
                    foreach ($data['failedRemarks'] as $i => $fail) {
                        if ($i < 15) {
                            $compute["carryover" . ($i + 1)] = $fail;
                        }
                    }
                }
                
                // Store serial number (index) and save the record
                $compute->sn = $index + 1;
                $compute->save();
            }
        }        

    // Return the success message
    // return redirect()->route('result-compute')->with('success', 'Result Computed Successfully.');

        $this->calculateFinalCgpa($acadSession, $programme, $level, $semester,$courseDuration);    
        // Return with success message
        return redirect()->route('result-compute')->with('success', 'Results Computed Successfully.');    
    }

    public function calculateFinalCgpa($acadSession, $programme, $level, $semester, $courseDuration)
    {
        // Step 1: Get all the results for the students based on the session, level, and course
        $results = Result::where('semester', $semester)
                        ->where('class', $level)
                        ->where('session1', $acadSession)
                        ->where('course', $programme)
                        ->get();

        $totalStudent = $results->count();  // Get the total number of students

        // Step 2: Loop through each student result
        foreach ($results as $result) {
            // Step 3: Get the relevant CGPA and grade points based on duration and level
            if ($courseDuration == 2 and $level == 200) {
                // Fetch CGPA and grade points for 100 level and 200 level second semesters
                $firstLevelData = ResultCompute::where('class', 100)
                                            ->where('semester', 'second')
                                            ->where('session1', $acadSession)
                                            ->where('course', $programme)
                                            ->where('admission_no', $result->admission_no) 
                                            ->first();

                $secondLevelData = ResultCompute::where('class', 200)
                                                ->where('semester', 'second')
                                                ->where('session1', $acadSession)
                                                ->where('course', $programme)
                                                ->where('admission_no', $result->admission_no) 
                                                ->first();

                // Fetch CGPA for the first and second levels
                $cgpa100 = $firstLevelData ? $firstLevelData->cgpa : 0;
                $cgpa200 = $secondLevelData ? $secondLevelData->cgpa : 0;

                // Calculate total grade points and total course units for 100 and 200 level second semesters
                $totalGradePoints100 = $firstLevelData ? $firstLevelData->all_total_grade_point : 0;
                $totalCourseUnits100 = $firstLevelData ? $firstLevelData->all_total_course_unit : 0;

                $totalGradePoints200 = $secondLevelData ? $secondLevelData->all_total_grade_point : 0;
                $totalCourseUnits200 = $secondLevelData ? $secondLevelData->all_total_course_unit : 0;

                // Calculate the total CGPA (sum of grade points / sum of course units)
                $totalGradePoints = $totalGradePoints100 + $totalGradePoints200;
                $totalCourseUnits = $totalCourseUnits100 + $totalCourseUnits200;

                $totalCgpa = ($totalCourseUnits > 0) ? $totalGradePoints / $totalCourseUnits : 0;

                // Save the CGPAs for the 200 level second semester
                if ($secondLevelData) {
                    $secondLevelData->cgpa1 = $cgpa100;
                    $secondLevelData->cgpa2 = $cgpa200;
                    $secondLevelData->total_cgpa = $totalCgpa;
                    $secondLevelData->total_grade_point_new = $totalGradePoints;
                    $secondLevelData->total_course_unit_new = $totalCourseUnits;
                    $secondLevelData->save();
                }                
        
            } elseif ($courseDuration == 2 and $level == NDII) {
                // Fetch CGPA and grade points for NDI level and NDII level second semesters
                $firstLevelData = ResultCompute::where('class', NDI)
                                            ->where('semester', 'second')
                                            ->where('session1', $acadSession)
                                            ->where('course', $programme)
                                            ->where('admission_no', $result->admission_no) 
                                            ->first();

                $secondLevelData = ResultCompute::where('class', NDII)
                                                ->where('semester', 'second')
                                                ->where('session1', $acadSession)
                                                ->where('course', $programme)
                                                ->where('admission_no', $result->admission_no) 
                                                ->first();

                // Fetch CGPA for the first and second levels
                $cgpa100 = $firstLevelData ? $firstLevelData->cgpa : 0;
                $cgpa200 = $secondLevelData ? $secondLevelData->cgpa : 0;

                // Calculate total grade points and total course units for NDI and NDII level second semesters
                $totalGradePoints100 = $firstLevelData ? $firstLevelData->all_total_grade_point : 0;
                $totalCourseUnits100 = $firstLevelData ? $firstLevelData->all_total_course_unit : 0;

                $totalGradePoints200 = $secondLevelData ? $secondLevelData->all_total_grade_point : 0;
                $totalCourseUnits200 = $secondLevelData ? $secondLevelData->all_total_course_unit : 0;

                // Calculate the total CGPA (sum of grade points / sum of course units)
                $totalGradePoints = $totalGradePoints100 + $totalGradePoints200;
                $totalCourseUnits = $totalCourseUnits100 + $totalCourseUnits200;

                $totalCgpa = ($totalCourseUnits > 0) ? $totalGradePoints / $totalCourseUnits : 0;

                // Save the CGPAs for the NDII level second semester
                if ($secondLevelData) {
                    $secondLevelData->cgpa1 = $cgpa100;
                    $secondLevelData->cgpa2 = $cgpa200;
                    $secondLevelData->total_cgpa = $totalCgpa;
                    $secondLevelData->total_grade_point_new = $totalGradePoints;
                    $secondLevelData->total_course_unit_new = $totalCourseUnits;
                    $secondLevelData->save();
                }                
        
            } elseif ($courseDuration == 2 and $level == HNDII) {
                // Fetch CGPA and grade points for HNDI level and HNDII level second semesters
                $firstLevelData = ResultCompute::where('class', HNDI)
                                            ->where('semester', 'second')
                                            ->where('session1', $acadSession)
                                            ->where('course', $programme)
                                            ->where('admission_no', $result->admission_no) 
                                            ->first();

                $secondLevelData = ResultCompute::where('class', HNDII)
                                                ->where('semester', 'second')
                                                ->where('session1', $acadSession)
                                                ->where('course', $programme)
                                                ->where('admission_no', $result->admission_no) 
                                                ->first();

                // Fetch CGPA for the first and second levels
                $cgpa100 = $firstLevelData ? $firstLevelData->cgpa : 0;
                $cgpa200 = $secondLevelData ? $secondLevelData->cgpa : 0;

                // Calculate total grade points and total course units for HNDI and HNDII level second semesters
                $totalGradePoints100 = $firstLevelData ? $firstLevelData->all_total_grade_point : 0;
                $totalCourseUnits100 = $firstLevelData ? $firstLevelData->all_total_course_unit : 0;

                $totalGradePoints200 = $secondLevelData ? $secondLevelData->all_total_grade_point : 0;
                $totalCourseUnits200 = $secondLevelData ? $secondLevelData->all_total_course_unit : 0;

                // Calculate the total CGPA (sum of grade points / sum of course units)
                $totalGradePoints = $totalGradePoints100 + $totalGradePoints200;
                $totalCourseUnits = $totalCourseUnits100 + $totalCourseUnits200;

                $totalCgpa = ($totalCourseUnits > 0) ? $totalGradePoints / $totalCourseUnits : 0;

                // Save the CGPAs for the HNDII level second semester
                if ($secondLevelData) {
                    $secondLevelData->cgpa1 = $cgpa100;
                    $secondLevelData->cgpa2 = $cgpa200;
                    $secondLevelData->total_cgpa = $totalCgpa;
                    $secondLevelData->total_grade_point_new = $totalGradePoints;
                    $secondLevelData->total_course_unit_new = $totalCourseUnits;
                    $secondLevelData->save();
                }                
        
            } elseif ($courseDuration == 3 and $level == 300) {
                // Fetch CGPA and grade points for 100, 200, and 300 level second semesters
                $firstLevelData = ResultCompute::where('class', 100)
                                            ->where('semester', 'second')
                                            ->where('session1', $acadSession)
                                            ->where('course', $programme)
                                            ->where('admission_no', $result->admission_no) 
                                            ->first();

                $secondLevelData = ResultCompute::where('class', 200)
                                                ->where('semester', 'second')
                                                ->where('session1', $acadSession)
                                                ->where('course', $programme)
                                                ->where('admission_no', $result->admission_no) 
                                                ->first();

                $thirdLevelData = ResultCompute::where('class', 300)
                                            ->where('semester', 'second')
                                            ->where('session1', $acadSession)
                                            ->where('course', $programme)
                                            ->where('admission_no', $result->admission_no) // Assuming student_id exists
                                            ->first();

                // Fetch CGPAs for all 3 levels
                $cgpa100 = $firstLevelData ? $firstLevelData->cgpa : 0;
                $cgpa200 = $secondLevelData ? $secondLevelData->cgpa : 0;
                $cgpa300 = $thirdLevelData ? $thirdLevelData->cgpa : 0;

                // Calculate total grade points and total course units for 100, 200, and 300 level second semesters
                $totalGradePoints100 = $firstLevelData ? $firstLevelData->all_total_grade_point : 0;
                $totalCourseUnits100 = $firstLevelData ? $firstLevelData->all_total_course_unit : 0;

                $totalGradePoints200 = $secondLevelData ? $secondLevelData->all_total_grade_point : 0;
                $totalCourseUnits200 = $secondLevelData ? $secondLevelData->all_total_course_unit : 0;

                $totalGradePoints300 = $thirdLevelData ? $thirdLevelData->all_total_grade_point : 0;
                $totalCourseUnits300 = $thirdLevelData ? $thirdLevelData->all_total_course_unit : 0;

                // Calculate the total CGPA (sum of grade points / sum of course units)
                $totalGradePoints = $totalGradePoints100 + $totalGradePoints200 + $totalGradePoints300;
                $totalCourseUnits = $totalCourseUnits100 + $totalCourseUnits200 + $totalCourseUnits300;

                $totalCgpa = ($totalCourseUnits > 0) ? $totalGradePoints / $totalCourseUnits : 0;

                // Save the CGPAs for the 300 level second semester
                if ($thirdLevelData) {
                    $thirdLevelData->cgpa1 = $cgpa100;
                    $thirdLevelData->cgpa2 = $cgpa200;
                    $thirdLevelData->cgpa3 = $cgpa300;
                    $thirdLevelData->total_cgpa = $totalCgpa;
                    $thirdLevelData->total_grade_point_new = $totalGradePoints;
                    $thirdLevelData->total_course_unit_new = $totalCourseUnits;
                    $thirdLevelData->save();
                }
            }
        }
        
    }


    public function resultDelete(Request $request)
    {
        $request->validate([
            'programme'     => 'required|string',
            'acad_session'  => 'required|integer',
            'stdLevel'      => 'required|string',
            'semester'      => 'required|string',
        ]);

        $deleted = ResultCompute::where('course', $request->programme)
                    ->where('session1', $request->acad_session)
                    ->where('class', $request->stdLevel)
                    ->where('semester', $request->semester)
                    ->delete();

        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Results deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No matching results found.'], 404);
        }
    }

    public function preview(Request $request)
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

    public function preview100First($acadSession, $programme, $level, $semester,Request $request)
    {

        try {
            // Query the results based on the validated data
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->paginate(1);

            // Check if the results are empty
            if ($results->isEmpty()) {
                // \Log::info('No results found for the given parameters.');
                return redirect()->route('result-compute-preview')->with('message', 'No results found.');
            }

            // Map the data into a format for the view
            $studentData = $results->map(function ($item) {
                return [
                    'stusurname' => $item->student_full_name ?? 'No Name',
                    'stuno' => $item->admission_no ?? 'No Matric No',
                    'class' => $item->class ?? 'No Level',
                    'coursekeep' => $item->course ?? 'No Programme',
                    'studpicture' => $item->picture_dir ?? 'No Picture',
                    'totalGradePoints' => $item->total_grade_point ?? 0,
                    'totalUnits' => $item->total_course_unit ?? 0,
                    'totalGPA' => $item->gpa ?? 0.0,
                    'letterGrade' => $item->subjectgrade1 ?? 'No Grade',
                    'remarks' => $item->remark ?? 'No Remarks',
                    'failedRemarks' => $item->failed_course ?? 'No failed course',
                    // Safely map course titles, grades, units, and scores
                    'ctitles' => array_map(fn($i) => $item->{"ctitle{$i}"} ?? null, range(1, 17)),
                    'subjects' => array_map(fn($i) => $item->{"subject{$i}"} ?? null, range(1, 16)),
                    'subjectGrades' => array_map(fn($i) => $item->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                    'units' => array_map(fn($i) => $item->{"unit{$i}"} ?? null, range(1, 18)),
                    'scores' => array_map(fn($i) => $item->{"score{$i}"} ?? null, range(1, 19)),
                ];
            });

            $hod = hod::where('course', $programme)->first();
            $grading = GradingSystem::first();
            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Render the view with the fetched data
            return view('results.student_result_page', [
                'results' => $results,
                'studentData' => $studentData,
                'semester' => $semester,
                'grades' => $grades,
                'hod' => $hod,
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error details: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());

            // Redirect with error message
            return view('results.student_result_page')->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function preview100Second($acadSession, $programme, $level, $semester,Request $request)
    {

        try {
            // Query the results based on the validated data
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->paginate(1);

            // Check if the results are empty
            if ($results->isEmpty()) {
                // \Log::info('No results found for the given parameters.');
                return redirect()->route('result-compute-preview')->with('message', 'No results found.');
            }

            // Map the data into a format for the view
            $studentData = $results->map(function ($item) {
                return [
                    'stusurname' => $item->student_full_name ?? 'No Name',
                    'stuno' => $item->admission_no ?? 'No Matric No',
                    'class' => $item->class ?? 'No Level',
                    'coursekeep' => $item->course ?? 'No Programme',
                    'studpicture' => $item->picture_dir ?? 'No Picture',
                    'totalGradePoints' => $item->total_grade_point ?? 0,
                    'totalUnits' => $item->total_course_unit ?? 0,
                    'totalGPA' => $item->gpa1 ?? 0.0,
                    'totalGPA2' => $item->gpa2 ?? 0.0,
                    'totalCGPA' => $item->cgpa ?? 0.0,
                    'letterGrade' => $item->subjectgrade1 ?? 'No Grade',
                    'remarks' => $item->remark ?? 'No Remarks',
                    'failedRemarks' => $item->failed_course ?? 'No failed course',
                    // Safely map course titles, grades, units, and scores
                    'ctitles' => array_map(fn($i) => $item->{"ctitle{$i}"} ?? null, range(1, 17)),
                    'subjects' => array_map(fn($i) => $item->{"subject{$i}"} ?? null, range(1, 16)),
                    'subjectGrades' => array_map(fn($i) => $item->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                    'units' => array_map(fn($i) => $item->{"unit{$i}"} ?? null, range(1, 18)),
                    'scores' => array_map(fn($i) => $item->{"score{$i}"} ?? null, range(1, 19)),
                ];
            });

            $hod = hod::where('course', $programme)->first();
            $grading = GradingSystem::first();
            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Render the view with the fetched data
            return view('results.student_result_page1', [
                'results' => $results,
                'studentData' => $studentData,
                'semester' => $semester,
                'grades' => $grades,
                'hod' => $hod,
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error details: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());

            // Redirect with error message
            return view('results.student_result_page1')->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function preview300Second($acadSession, $programme, $level, $semester,Request $request)
    {

        try {
            // Query the results based on the validated data
            $results = ResultCompute::where('course', $programme)
                ->where('session1', $acadSession)
                ->where('class', $level)
                ->where('semester', $semester)
                ->paginate(1);

            // Check if the results are empty
            if ($results->isEmpty()) {
                // \Log::info('No results found for the given parameters.');
                return redirect()->route('result-compute-preview')->with('message', 'No results found.');
            }

            // Map the data into a format for the view
            $studentData = $results->map(function ($item) {
                return [
                    'stusurname' => $item->student_full_name ?? 'No Name',
                    'stuno' => $item->admission_no ?? 'No Matric No',
                    'class' => $item->class ?? 'No Level',
                    'coursekeep' => $item->course ?? 'No Programme',
                    'studpicture' => $item->picture_dir ?? 'No Picture',
                    'totalGradePoints' => $item->total_grade_point ?? 0,
                    'totalUnits' => $item->total_course_unit ?? 0,
                    'totalGPA' => $item->gpa1 ?? 0.0,
                    'totalGPA2' => $item->gpa2 ?? 0.0,
                    'totalCGPA' => $item->cgpa ?? 0.0,
                    'letterGrade' => $item->subjectgrade1 ?? 'No Grade',
                    'remarks' => $item->remark ?? 'No Remarks',
                    'failedRemarks' => $item->failed_course ?? 'No failed course',
                    'cgpa1' => $item->cgpa1 ?? 0.0,
                    'cgpa2' => $item->cgpa2 ?? 0.0,
                    'cgpa3' => $item->cgpa3 ?? 0.0,
                    'totalCGPANEW' => $item->total_cgpa ?? 0.0,
                    'total_grade_point_new' => $item->total_grade_point_new,
                    'total_course_unit_new' => $item->total_course_unit_new,
                    // Safely map course titles, grades, units, and scores
                    'ctitles' => array_map(fn($i) => $item->{"ctitle{$i}"} ?? null, range(1, 17)),
                    'subjects' => array_map(fn($i) => $item->{"subject{$i}"} ?? null, range(1, 16)),
                    'subjectGrades' => array_map(fn($i) => $item->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                    'units' => array_map(fn($i) => $item->{"unit{$i}"} ?? null, range(1, 18)),
                    'scores' => array_map(fn($i) => $item->{"score{$i}"} ?? null, range(1, 19)),
                ];
            });

            $hod = hod::where('course', $programme)->first();
            $grading = GradingSystem::first();
            $grades = [
                ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
                ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
                ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
                ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
                ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
                ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
            ];

            // Render the view with the fetched data
            return view('results.student_result_page2', [
                'results' => $results,
                'studentData' => $studentData,
                'semester' => $semester,
                'grades' => $grades,
                'hod' => $hod,
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error details: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());

            // Redirect with error message
            return view('results.student_result_page1')->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function semesterResult()
    {
        $user = auth()->user();
        $rolePermission = $user->result_compute;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }
        
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allLevel = StudentLevel::all();

        return view('layout.semester-result', compact('programmes','allLevel'));
    }

    public function semesterResultAction(Request $request)
    {
        $validated = $request->validate([
            'programme' => 'required|string',
            'acad_session' => 'required|string',
            'stdLevel' => 'required|string',
            'semester' => 'required|string',
        ]);
    
        $results = ResultCompute::where('course', $validated['programme'])
            ->where('session1', $validated['acad_session'])
            ->where('semester', $validated['semester'])
            ->where('class', $validated['stdLevel'])
            ->get(); 

        $programme = $validated['programme'];
        $acadsession = $validated['acad_session'];
        $stdLevel = $validated['stdLevel'];
        $semester = $validated['semester'];
    
        
        return view('layout.semester-result-view', compact('results','programme','semester','acadsession','stdLevel'));
    }

    public function semesterSummary()
    {
        $user = auth()->user();
        $rolePermission = $user->result_compute;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }
        
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allLevel = StudentLevel::all();

        return view('layout.semester-result-summary', compact('programmes','allLevel'));
    }

    public function semesterSummaryAction(Request $request)
    {
        $validated = $request->validate([
            'programme' => 'required|string',
            'acad_session' => 'required|string',
            'stdLevel' => 'required|string',            
        ]);
    
        $results = ResultCompute::where('course', $validated['programme'])
            ->where('session1', $validated['acad_session'])
            ->where('semester', 'Second')
            ->where('class', $validated['stdLevel'])
            ->get(); 

        $programme = $validated['programme'];
        $acadsession = $validated['acad_session'];
        $stdLevel = $validated['stdLevel'];       
    
        
        return view('layout.semester-result-summary-view', compact('results','programme','acadsession','stdLevel'));
    }

    public function studentTranscript()
    {
        $user = auth()->user();
        $rolePermission = $user->transcript;

        if($rolePermission != 1) {
            return redirect()->back()->with('error', 'You do not have permission to this module.');
        }
        
        $programmes = CourseStudyAll::orderBy('department', 'asc')->get();
        $allLevel = StudentLevel::all();        

        return view('results.student_transcript', compact('programmes','allLevel'));
    }

    public function studentTranscriptAction(Request $request)
    {
        // Validate the request
        $request->validate([
            'programme' => 'required|string',
            'acad_session' => 'required|integer'
        ]);

        $programme = $request->programme;
        $admissionYear = $request->acad_session;
        // Fetch students who match the given programme and admission year
        $students = Registration::where('course', $programme)
            ->where('admission_year', $admissionYear)
            ->orderBy('admission_no', 'asc')
            ->get();

        // Return view with students
        return view('results.student_transcript_view', compact('students','programme', 'admissionYear'));
    }

    public function studentTranscriptPreview(Request $request)
    {
        $validated = $request->validate([
            'stdLevel' => 'required|string',
            'acad_session' => 'required|string',
            'programme' => 'required|string',
            'admission_no' => 'required|string',
        ]);
    
        $level = $validated['stdLevel'];
        $acadSession = $validated['acad_session'];
        $programme = $validated['programme'];
        $admissionNo = $validated['admission_no'];
    
        $courseStudy = CourseStudy::where('dept_name', $programme)->first();
        $courseDuration = $courseStudy->dept_duration;
    
        if ($courseDuration == 2 && $level == '100') {
            $levels = ['100', '200'];
        } elseif ($courseDuration == 2 && $level == 'NDI') {
            $levels = ['NDI', 'NDII'];
        } elseif ($courseDuration == 2 && $level == 'HNDI') {
            $levels = ['HNDI', 'HNDII'];
        } elseif ($courseDuration == 3 && $level == '100') {
            $levels = ['100', '200', '300'];
        }
    
        $semesters = ['First', 'Second'];
        $allSemesters = [];
    
        foreach ($levels as $lvl) {
            foreach ($semesters as $sem) {
                $results = ResultCompute::where('course', $programme)
                    ->where('session1', $acadSession)
                    ->where('admission_no', $admissionNo)
                    ->where('class', $lvl)
                    ->where('semester', $sem)
                    ->get();
    
                if ($results->isEmpty()) continue;
    
                $studentData = $results->map(function ($item) use ($courseDuration) {
                    return [
                        'stusurname' => $item->student_full_name,
                        'stuno' => $item->admission_no,
                        'class' => $item->class,
                        'coursekeep' => $item->course,
                        'studpicture' => $item->picture_dir,
                        'totalGradePoints' => $item->total_grade_point,
                        'totalUnits' => $item->total_course_unit,
                        'totalGPA' => $item->gpa,
                        'gpa1' => $item->gpa1 ?? 0.0,
                        'gpa2' => $item->gpa2 ?? 0.0,
                        'cgpa' => $item->cgpa ?? 0.0,
                        'cgpa1' => $item->cgpa1 ?? 0.0,
                        'cgpa2' => $item->cgpa2 ?? 0.0,
                        'cgpa3' => $item->cgpa3 ?? 0.0,
                        'totalcgpa' => $item->total_cgpa ?? 0.0,
                        'letterGrade' => $item->subjectgrade1,
                        'remarks' => $item->remark,
                        'failedRemarks' => $item->failed_course,
                        'ctitles' => array_map(fn($i) => $item->{"ctitle{$i}"} ?? null, range(1, 17)),
                        'subjects' => array_map(fn($i) => $item->{"subject{$i}"} ?? null, range(1, 16)),
                        'subjectGrades' => array_map(fn($i) => $item->{"subjectgrade{$i}"} ?? null, range(1, 17)),
                        'units' => array_map(fn($i) => $item->{"unit{$i}"} ?? null, range(1, 18)),
                        'scores' => array_map(fn($i) => $item->{"score{$i}"} ?? null, range(1, 19)),
                        'courseDuration' => $courseDuration, 
                    ];
                });
    
                $allSemesters[] = [
                    'level' => $lvl,
                    'semester' => $sem,
                    'studentData' => $studentData,
                ];
            }
        }
    
        $grading = GradingSystem::first();
        $hod = hod::where('course', $programme)->first();
    
        $grades = [
            ['min' => $grading->grade01, 'max' => $grading->grade02, 'unit' => $grading->unit01, 'letter_grade' => $grading->lgrade1],
            ['min' => $grading->grade11, 'max' => $grading->grade12, 'unit' => $grading->unit02, 'letter_grade' => $grading->lgrade2],
            ['min' => $grading->grade21, 'max' => $grading->grade22, 'unit' => $grading->unit03, 'letter_grade' => $grading->lgrade3],
            ['min' => $grading->grade31, 'max' => $grading->grade32, 'unit' => $grading->unit04, 'letter_grade' => $grading->lgrade4],
            ['min' => $grading->grade41, 'max' => $grading->grade42, 'unit' => $grading->unit05, 'letter_grade' => $grading->lgrade5],
            ['min' => $grading->grade51, 'max' => $grading->grade52, 'unit' => $grading->unit06, 'letter_grade' => $grading->lgrade6],
        ];
    
        return view('results.student_full_transcript', compact('allSemesters', 'grades', 'hod'));
    
    }

    public function cgpaSummary()
    {
        return redirect()->route('page-development'); 
    }

    public function resultResit(Request $request)
    {
        $validatedData = $request->validate([
            'stdLevel'     => 'required|string',
            'semester'     => 'required|string',
            'acad_session' => 'required|string',
            'programme'    => 'required|string',
        ]);

        $currentLevel   = (int) $validatedData['stdLevel'];
        $currentSemester = ucfirst(strtolower($validatedData['semester']));
        $acadSession    = $validatedData['acad_session'];
        $programme      = $validatedData['programme'];

        // 🔁 Determine previous level and semester
        if ($currentSemester === 'First') {
            $previousSemester = 'Second';
            $previousLevel = $currentLevel - 100;
        } else {
            $previousSemester = 'First';
            $previousLevel = $currentLevel;
        }

        // Check course study
        $courseStudy = CourseStudy::where('dept_name', $programme)->first();
        $courseDuration = $courseStudy->dept_duration ?? null;

        // Fetch students
        $students = Registration::where('course', $programme)
            ->where('admission_year', $acadSession)
            ->get();

        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'Students unavailable');
        }

        $studentsWithFailedCourses = [];

        foreach ($students as $student) {
            $failed = DB::table('result_computes')
                ->where('admission_no', $student->admission_no)
                ->where('class', $previousLevel)
                ->where('semester', $previousSemester)
                ->where('session1', $acadSession)
                ->first();

            if ($failed && !empty($failed->failed_course)) {
                $failedCourses = array_map('trim', explode(',', $failed->failed_course));
                $studentsWithFailedCourses[] = [
                    'student' => $student,
                    'failed_courses' => $failedCourses,
                    'previous_level' => $previousLevel,
                    'previous_semester' => $previousSemester,
                ];
            }
        }

        if (empty($studentsWithFailedCourses)) {
            return redirect()->back()->with('error', 'No failed courses found for selected criteria.');
        }

        return view('layout.result-resit', compact(
            'studentsWithFailedCourses', 'programme', 'acadSession', 'currentLevel', 'currentSemester'
        ));
    }

    public function processResit(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'admission_no' => 'required|exists:registrations,admission_no',
            'currentLevel'   => 'required|string',
            'currentSemester'=> 'required|string',
            'programme'      => 'required|string',
            'acadSession'    => 'required|string',
        ]);


        // return response()->json([$validated]);
        $studentId       = $validated['admission_no'];
        $currentLevel    = $validated['currentLevel'];
        $currentSemester = ucfirst(strtolower($validated['currentSemester']));
        $programme = $validated['programme'];
        $acadSession = $validated['acadSession'];

        // Fetch student
        $student = Registration::where('admission_no', $studentId);
        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        // Check if result exists for current level/semester
        $result = Result::where('admission_no', $studentId)
                        ->where('class', $currentLevel)
                        ->where('semester', $currentSemester)
                        ->first();

        // If result does not exist, call function to generate result
        if (!$result) {
            $this->generateResultForLevel($programme, $acadSession, $currentLevel, $currentSemester); // <--- Custom function
            $result = Result::where('admission_no', $studentId)
                            ->where('class', $currentLevel)
                            ->where('semester', $currentSemester)
                            ->first();

            if (!$result) {
                return back()->with('error', "Results not yet processed for {$currentLevel}/{$currentSemester}.");
            }
        }

        // Determine previous semester and level
        $previousSemester = strtolower($currentSemester) === 'second' ? 'first' : 'second';
        $previousLevel = strtolower($currentSemester) === 'second'
            ? $currentLevel
            : ((int)$currentLevel - 100); // if first semester, previous level is one level before

        if ($previousLevel < 100) {
            return back()->with('info', 'No previous level to fetch failed courses from.');
        }

        // Fetch failed courses from result_computes (previous level/semester)
        $compute = ResultCompute::where('admission_no', $studentId)
            ->where('class', $previousLevel)
            ->where('semester', ucfirst($previousSemester))
            ->first();

        if (!$compute || !$compute->failed_course) {
            return back()->with('info', 'No failed courses found for previous level/semester.');
        }

        $failedCourses = array_map('trim', explode(',', $compute->failed_course));

        // Get existing subjects to avoid duplicates
        $existingSubjects = [];
        for ($i = 1; $i <= 15; $i++) {
            if (!empty($result["ctitle$i"])) {
                $existingSubjects[] = strtoupper(trim($result["ctitle$i"]));
            }
        }

        // Append failed courses (non-duplicate)
        $added = 0;
        $nextIndex = count($existingSubjects) + 1;

        foreach ($failedCourses as $courseCode) {
            $courseCode = strtoupper(trim($courseCode));
            if (in_array($courseCode, $existingSubjects)) {
                continue;
            }

            if ($nextIndex > 15) break;

            $course = Course::where('course_code', $courseCode)->first();
            if (!$course) continue;

            $result->{"ctitle$nextIndex"} = $course->course_code;
            $result->{"unit$nextIndex"}   = $course->course_unit;
            $result->{"subject$nextIndex"}= $course->course_title;
            $result->{"score$nextIndex"}  = 0;

            $added++;
            $nextIndex++;
        }

        $result->no_of_course = ($result->no_of_course ?? 0) + $added;
        $result->save();

        if ($added === 0) {
            return back()->with('error', 'All failed courses from the previous level/semester have already been added.');
        }
        
        return back()->with('success', "$added failed course(s) added successfully to {$currentLevel}/{$currentSemester}.");
    }

    protected function generateResultForLevel($programme, $acadSession, $currentLevel, $currentSemester)
    {
        $user = auth()->user();      

        $admissionYear = $acadSession;
        $programme = $programme;
        $stdLevel = $currentLevel;
        $semester = $currentSemester;
        $year = $acadSession;

        // Check curriculum
        $curriculumExist = Course::where('course', $programme)->exists();
        if (!$curriculumExist) {
            return redirect()->back()->with('error', 'Curriculum for this course is unavailable.');
        }

        // Get registered students
        $students = Registration::where('course', $programme)
            // ->where('class', $stdLevel)
            ->where('admission_year', $year)
            ->get();
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No students found for this academic session.');
        }

        // Get assigned courses
        $courses = Course::where('course', $programme)
            ->where('level', $stdLevel)
            ->where('semester', $semester)
            ->get();

        // Get existing results
        $existingResults = Result::where('course', $programme)
            ->where('class', $stdLevel)
            ->where('session1', $year)
            ->where('semester', $semester)
            ->get();

        //  If results exist, ensure new students are added
        if ($existingResults->isNotEmpty()) {
            $existingAdmissionNumbers = $existingResults->pluck('admission_no')->toArray();

            foreach ($students as $student) {
                if (!in_array($student->admission_no, $existingAdmissionNumbers)) {
                    // Create result entry for the student not in result table
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
                        $resultData->{'score' . $courseIndex} = 0;
                        $courseIndex++;
                    }

                    $resultData->no_of_course = $courses->count();
                    $resultData->save();

                    // Add new result to existing collection
                    $existingResults->push($resultData);
                }
            }

            // Prepare result scores
            $studentScores = [];
            foreach ($existingResults as $result) {
                foreach ($courses as $course) {
                    $courseIndex = $courses->search(function ($item) use ($course) {
                        return $item->course_title === $course->course_title;
                    }) + 1;

                    $studentScores[$result->admission_no][$course->id] = $result->{'score' . $courseIndex} ?? 0;
                }
            }
            
        }

        if ($existingResults->isEmpty()) {
           //  If no results exist, create result entries for all
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
                    $resultData->{'score' . $courseIndex} = 0;
                    $courseIndex++;
                }

                $resultData->no_of_course = $courses->count();
                $resultData->save();
            }
        
        }
    }

    public function fetchFailedCourses(Request $request)
    {
        $admissionNo = $request->admission_no;
        $level = $request->level; // current level
        $semester = $request->semester; // current semester
        $admissionYear = $request->admissionYear;

        // Log incoming request data
        // \Log::info("Fetching failed courses for student:", [
        //     'admission_no' => $admissionNo,
        //     'level' => $level,
        //     'semester' => $semester,
        //     'admissionYear' => $admissionYear
        // ]);

        // Determine previous level and semester
        [$prevLevel, $prevSemester] = $this->getPreviousLevelAndSemester($level, $semester);

        // Step 1: Get failed courses from the previous result
        $previousResult = DB::table('result_computes')
            ->where('admission_no', $admissionNo)
            ->where('class', $prevLevel)
            ->where('semester', $prevSemester)
            ->where('session1', $admissionYear)
            ->first();

        // Log the previous result
        // \Log::info("Previous Result:", ['previousResult' => $previousResult]);

        if (!$previousResult || empty($previousResult->failed_course)) {
            return response()->json(['failedCourses' => []]);
        }

        $failedCourses = array_map('trim', explode(',', $previousResult->failed_course));

        // Step 2: Get current result to find index of course codes
        $currentResult = DB::table('results')
            ->where('admission_no', $admissionNo)
            ->where('class', $level)
            ->where('semester', $semester)
            ->where('session1', $admissionYear)
            ->first();

        // Log the current result
        // \Log::info("Current Result:", ['currentResult' => $currentResult]);

        if (!$currentResult) {
            return response()->json(['failedCourses' => []]);
        }

        $filtered = [];

        foreach ($failedCourses as $failedCourse) {
            for ($i = 1; $i <= 20; $i++) {
                $ctitleKey = 'ctitle' . $i;
                $scoreKey = 'score' . $i;
                $subjectKey = 'subject'. $i;

                if (
                    isset($currentResult->$ctitleKey) &&
                    strtoupper(trim($currentResult->$ctitleKey)) === strtoupper($failedCourse)
                ) {
                    $filtered[] = [
                        'course_code' => $failedCourse,
                        'current_score' => $currentResult->$scoreKey,
                        'subject' => $currentResult->$subjectKey,
                        'index' => $i,
                    ];
                    break;
                }
            }
        }

        // Log the filtered results
        // \Log::info("Filtered Failed Courses:", ['filtered' => $filtered]);

        return response()->json(['failedCourses' => $filtered]);
    }

    public function saveResitScores(Request $request)
    {
       \Log::info('Incoming Resit Scores Request:', $request->all());

        $validated = $request->validate([
            'resit_scores' => 'required|array',
            'resit_scores.*.index' => 'required|integer',
            'resit_scores.*.resit_score' => 'required|numeric|min:0|max:100',
            'student_id' => 'required|string',
            'level' => 'required|string',
            'semester' => 'required|string',
            'admission_year' => 'required|string',
        ]);

        $studentId = $validated['student_id'];
        $level = $validated['level'];
        $semester = $validated['semester'];
        $admissionYear = $validated['admission_year'];

        foreach ($validated['resit_scores'] as $resitData) {
            $columnName = 'score' . $resitData['index'];
            $resitScore = $resitData['resit_score'];

            // Ensure the column name is valid to avoid SQL injection
            if (!preg_match('/^score\d+$/', $columnName)) {
                continue; // skip invalid column
            }

            // Update the specific score column dynamically
            DB::table('results')
                ->where('admission_no', $studentId)
                ->where('class', $level)
                ->where('semester', $semester)
                ->where('session1', $admissionYear)
                ->update([
                    $columnName => $resitScore,
                ]);
        }

        return response()->json(['success' => true, 'message' => 'Resit scores updated successfully.']);
    }



}
