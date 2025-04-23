@props(['student', 'semester', 'grades', 'hod'])

{{-- Begin Student Report --}}
<div style="page-break-after: always;">
    {{-- Existing report content here --}}
    <div class="card mb-4">
    <div class="card-body">
    

        {{-- Student Information --}}
        <table class="table table-bordered align-middle">
            <tr>
                <td rowspan="4" style="width: 150px; text-align: center;">
                    @php
                        $imagePath = public_path('uploads/' . $student['studpicture'] . '.jpg');
                        $imageUrl = file_exists($imagePath) 
                            ? asset('uploads/' . $student['studpicture'] . '.jpg') 
                            : asset('uploads/blank.jpg');
                    @endphp
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="Student Picture" 
                        class="img-thumbnail" 
                        style="max-width: 130px;">                </td>
                <th>Full Name:</th>
                <td colspan="3">{{ $student['stusurname'] }}</td>
            </tr>
            <tr><th>Matric No:</th><td colspan="3">{{ $student['stuno'] }}</td></tr>
            <tr><th>Level:</th><td>{{ $student['class'] }}</td>
              <th>Semester</th>
              <td>{{ $semester['semester'] }}</td>
            </tr>
            <tr><th>Programme:</th><td colspan="3">{{ $student['coursekeep'] }}</td></tr>
        </table>
    </div>
</div>

{{-- Results --}}
@include('components.reports.results-table1', ['student' => $student, 'grades' => $grades, 'hod' => $hod])
</div>

