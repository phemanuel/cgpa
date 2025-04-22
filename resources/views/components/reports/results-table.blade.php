<div class="row">
    <div class="col-md-8">
        {{-- Results Table --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Code</th>
                            <th>Course</th>
                            <th>Unit</th>
                            <th>Average(100)</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($student['subjects']) && is_array($student['subjects']) && count($student['subjects']) > 0)
                            @foreach ($student['subjects'] as $index => $subject)
                                @if(!empty($subject) && !is_null($subject))
                                <tr>
                                    <td style="font-size: 13px;">{{ $student['ctitles'][$index] }}</td>
                                    <td style="text-align: left; font-size: 13px;">{{ $subject }}</td>
                                    <td style="font-size: 13px;">{{ $student['units'][$index] }}</td>
                                    <td style="font-size: 13px;">
                                        {{ floor($student['scores'][$index]) == $student['scores'][$index] 
                                            ? (int) $student['scores'][$index] 
                                            : $student['scores'][$index] }}
                                    </td>
                                    <td style="font-size: 13px;">{{ $student['subjectGrades'][$index] }}</td>
                                </tr>
                                @endif
                            @endforeach
                        @else
                            <tr><td colspan="5">No subjects available</td></tr>
                        @endif
                    </tbody>
                </table>

                {{-- GPA Summary --}}
                <table class="table table-bordered table-sm mt-4">
    <tbody>
        <tr>
            <td><strong>Total Grade Points:</strong></td>
            <td>{{ $student['totalGradePoints'] }}</td>
            <td></td>
            <td rowspan="6" style="text-align: center; vertical-align: middle;">
                {{-- Show grade only in Second semester --}}
                @if ($semester['semester'] === 'Second' && isset($student['cgpa']))
                    @php $cgpa = $student['cgpa']; @endphp
                    <div style="font-size: 13px; margin-bottom: 8px;">
                        @if ($cgpa < 2.0)
                            <span class="badge bg-danger text-white">Fail</span>
                        @elseif ($cgpa >= 2.0 && $cgpa <= 2.49)
                            <span class="badge bg-warning text-white">Pass</span>
                        @elseif ($cgpa >= 2.5 && $cgpa <= 2.9)
                            <span class="badge bg-info text-white">Lower Credit</span>
                        @elseif ($cgpa >= 3.0 && $cgpa <= 3.49)
                            <span class="badge bg-primary text-white">Upper Credit</span>
                        @elseif ($cgpa >= 3.5 && $cgpa <= 4.0)
                            <span class="badge bg-success text-white">Distinction</span>
                        @endif
                    </div>
                @endif

                {{-- Signature and HOD name --}}
                <div style="margin-top: 8px;">
                    <img src="{{ asset('signature/' . $hod->sign) }}" width="160" height="60">
                </div>
                <div style="font-size: 13px; margin-top: 5px;">
                    <strong>{{ $hod->hod_name }}</strong>
                </div>
            </td>
        </tr>

        <tr>
            <td><strong>Total Units:</strong></td>
            <td>{{ $student['totalUnits'] }}</td>
            <td></td>
        </tr>

        @if ($semester['semester'] === 'First' && $student['class'] == 100 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA:</strong></td>
                <td>{{ $student['totalGPA'] ?? 'N/A' }}</td>
                <td></td>
            </tr>
        @elseif ($semester['semester'] === 'First' && $student['class'] == 200 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA:</strong></td>
                <td>{{ $student['totalGPA'] ?? 'N/A' }}</td>
                <td></td>
            </tr>
        @elseif ($semester['semester'] === 'First' && $student['class'] == 300 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA:</strong></td>
                <td>{{ $student['totalGPA'] ?? 'N/A' }}</td>
                <td></td>
            </tr>
        @elseif ($semester['semester'] === 'Second' && $student['class'] == 100 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA 1:</strong></td>
                <td>{{ $student['gpa1'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>GPA 2:</strong></td>
                <td>{{ $student['gpa2'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>CGPA:</strong></td>
                <td>{{ $student['cgpa'] ?? '-' }}</td>
                <td></td>
            </tr>
        @elseif ($semester['semester'] === 'Second' && $student['class'] == 200 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA 1:</strong></td>
                <td>{{ $student['gpa1'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>GPA 2:</strong></td>
                <td>{{ $student['gpa2'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>CGPA:</strong></td>
                <td>{{ $student['cgpa'] ?? '-' }}</td>
                <td></td>
            </tr>
        @elseif ($semester['semester'] === 'Second' && $student['class'] == 300 && $student['courseDuration'] == 3)
            <tr>
                <td><strong>GPA 1:</strong></td>
                <td>{{ $student['gpa1'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>GPA 2:</strong></td>
                <td>{{ $student['gpa2'] ?? '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>CGPA:</strong></td>
                <td>{{ $student['cgpa'] ?? '-' }}</td>
                <td></td>
            </tr>
        @endif

        <tr>
            <td><strong>Remark:</strong></td>
            <td>
                <span class="{{ $student['remarks'] === 'PASSED ALL' ? 'text-success' : 'text-danger' }}">
                    {{ $student['remarks'] }}
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>

        @if (!empty($student['failedRemarks']))
        <tr>
            <td><strong>Courses with Carryover:</strong></td>
            <td colspan="3">{{ $student['failedRemarks'] }}</td>
        </tr>
        @endif
    </tbody>
</table>

            </div>
        </div>
    </div>

    {{-- Grading System & Classification --}}
    <div class="col-md-4">
        @include('components.reports.grading-classification', ['grades' => $grades])
    </div>
</div>
