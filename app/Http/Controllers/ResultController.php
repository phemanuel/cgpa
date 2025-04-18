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
        
        // Validate incoming parameters
        $validated = $request->validate([
            'acad_session' => 'required|string|size:9', 
            'programme' => 'required|string|exists:course_study_all,department', 
            'stdLevel' => 'required|string|in:100,200,300,NDI,NDII,HNDI,HNDII', 
            'semester' => 'required',
        ]);

        // Extract validated parameters
        $admissionYear = $validated['acad_session'];
        $programme = $validated['programme'];
        $stdLevel = $validated['stdLevel'];
        $semester = $validated['semester'];
        $year = substr($admissionYear, 0, 4); // Get the year from the acad_session

        //--- Check if curriculum is available
        $curriculumExist = Course::where('course', $programme)->exists();
        if (!$curriculumExist) {
            return redirect()->back()->with('error', 'Curriculum for this course is unavailable.');
        }

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
                    // Determine the course index dynamically
                    $courseIndex = $courses->search(function ($item) use ($course) {
                        return $item->course_title === $course->course_title;
                    }) + 1; // Adding 1 as index starts from 1 in the original code

                    // Collect student scores for each course
                    $studentScores[$result->admission_no][$course->id] = $result->{'score' . $courseIndex} ?? 0;
                }
            }

            return view('layout.result-entry-view-admin', compact(
                'students', 'existingResults', 'courses', 'studentScores', 
                'programme', 'admissionYear', 'stdLevel', 'semester'
            ));
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

            return view('layout.result-entry-view-admin', compact(
                'students', 'courses', 'programme', 'admissionYear', 'stdLevel', 'semester'
            ));
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
                $compute->cgpa = round(($data['totalGPA'] + $firstSemesterData[$index]['gpa']) / 2, 2); // Combined CGPA
                
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
                $compute->cgpa = round(($data['totalGPA'] + $firstSemesterData[$index]['gpa']) / 2, 2); // Combined CGPA
                
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
        $courseStudy = CourseStudy::where('dept_name', $validatedData['programme'])->first();
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
                $compute->cgpa = round(($data['totalGPA'] + $firstSemesterData[$index]['gpa']) / 2, 2); // Combined CGPA
                
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

        $this->calculateFinalCgpa($acadSession, $programme, $level, $semester,$courseDuration);
        //return redirect()->route('result-compute')->with('success' , 'Result Computed Successfuly.');
    }

    public function calculateFinalCgpa($acadSession, $programme, $level, $semester, $courseDuration)
    {
        // Step 1: Determine which levels to fetch CGPA from based on the selected course duration and level
        $levelsToFetch = $this->getLevelsToFetch($courseDuration, $level);

        // Step 2: Fetch CGPAs for the relevant levels
        $cgpas = [];
        foreach ($levelsToFetch as $lvl) {
            $cgpas[] = $this->getCgpa($acadSession, $programme, $lvl, $semester);
        }

        // Step 3: Fetch total grade points and course units for the relevant levels and second semester
        $totalGradePoints = 0;
        $totalCourseUnits = 0;
        foreach ($levelsToFetch as $lvl) {
            $result = $this->getTotalGradePointsAndUnits($acadSession, $programme, $lvl, $semester);
            $totalGradePoints += $result['all_total_grade_point'];
            $totalCourseUnits += $result['all_total_course_unit'];
        }

        // Step 4: Calculate the total CGPA
        if ($totalCourseUnits > 0) {
            $finalCgpa = $totalGradePoints / $totalCourseUnits;
        } else {
            $finalCgpa = 0; // Handle division by zero if no course units are found
        }

        // Step 5: Determine the remark based on CGPA
        $remark = $this->getRemarkForCgpa($finalCgpa);

        // Step 6: Save the CGPA and remarks for the selected level and semester
        $this->saveCgpasAndRemark($acadSession, $programme, $level, $semester, $cgpas, $finalCgpa, $remark);

        // Step 7: Redirect to the result computation page with success message
        return redirect()->route('result-compute')->with('success', 'Result Computed Successfully.');
    }

    private function getLevelsToFetch($courseDuration, $level)
    {
        // Step 1: Determine which levels need to be fetched based on course duration and selected level
        if ($courseDuration == 2) {
            if ($level == 200) {
                return [100, 200];
            } elseif ($level == 'NDII') {
                return ['NDI', 'NDII'];
            } elseif ($level == 'HNDII') {
                return ['HNDI', 'HNDII'];
            }
        } elseif ($courseDuration == 3) {
            if ($level == 300) {
                return [100, 200, 300];
            }
        }

        // Default case (could be more specific depending on requirements)
        return [$level];
    }

    private function getCgpa($acadSession, $programme, $level, $semester)
    {
        // Step 2: Query the database for the CGPA of the given level, programme, session, and semester
        return DB::table('result_computes')
            ->where('acad_session', $acadSession)
            ->where('programme_id', $programme->id)
            ->where('level', $level)
            ->where('semester', $semester)
            ->value('cgpa');
    }

    private function getTotalGradePointsAndUnits($acadSession, $programme, $level, $semester)
    {
        // Step 3: Query the database for total grade points and total course units for the given level and semester
        return DB::table('result_computes')
            ->where('acad_session', $acadSession)
            ->where('programme_id', $programme->id)
            ->where('level', $level)
            ->where('semester', $semester)
            ->selectRaw('SUM(grade_point) as all_total_grade_point, SUM(course_unit) as all_total_course_unit')
            ->first();
    }

    private function getRemarkForCgpa($finalCgpa)
    {
        // Step 5: Determine the remark based on CGPA
        if ($finalCgpa >= 4.50) {
            return 'Excellent';
        } elseif ($finalCgpa >= 3.50) {
            return 'Good';
        } elseif ($finalCgpa >= 2.40) {
            return 'Fair';
        } elseif ($finalCgpa >= 1.50) {
            return 'Pass';
        } else {
            return 'Fail';
        }
    }

    private function saveCgpasAndRemark($acadSession, $programme, $level, $semester, $cgpas, $finalCgpa, $remark)
    {
        // Step 6: Save CGPAs (cgpa1, cgpa2, cgpa3) and the final CGPA, along with the remark
        $data = [
            'acad_session' => $acadSession,
            'programme_id' => $programme->id,
            'level' => $level,
            'semester' => $semester,
            'cgpa1' => $cgpas[0] ?? null, // CGPA for year 1
            'cgpa2' => $cgpas[1] ?? null, // CGPA for year 2
            'cgpa3' => $cgpas[2] ?? null, // CGPA for year 3 (only for 3-year courses)
            'all_total_grade_point' => $finalCgpa,   // Final calculated CGPA
            'all_total_course_unit' => $finalCgpa,   // You can adjust this depending on your actual calculation logic
            'cgpa_remark' => $remark      // Remark based on the CGPA
        ];

        // Insert or update the result in the result_computes table
        DB::table('result_computes')
            ->updateOrInsert(
                ['acad_session' => $acadSession, 'programme_id' => $programme->id, 'level' => $level, 'semester' => $semester],
                $data
            );
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
            ];
        }
        elseif($courseDuration == 3){
                // Define the mapping of level and semester combinations to methods
                $methodMap = [
                    '100'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                    '200'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                    '300'  => ['First' => 'preview100First',  'Second' => 'preview300Second'],
                    'NDI'  => ['First' => 'preview100First',  'Second' => 'preview100Second'],
                    'NDII' => ['First' => 'preview100First',  'Second' => 'preview300Second'],
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

}
