@foreach ($users as $key => $rd)
<tr>
    <td></td>
    <td>
        <img 
            alt="Profile Picture" 
            src="{{ file_exists(public_path('uploads/' . $rd->picture_dir . '.jpg')) ? asset('uploads/' . $rd->picture_dir . '.jpg') : asset('uploads/blank.jpg') }}" 
            class="user-img-radious-style" 
            width="50" height="50">
    </td>
    <td>{{ $rd->admission_no }}</td>
    <td>{{ $rd->student_full_name }}</td>
    <td>{{ $rd->course }}</td>
    <td><div class="badge badge-info">{{ $rd->admission_year }}</div></td>
    <td>
        <a href="{{ route('edit-student', ['id' => $rd->id]) }}" class="btn btn-outline-primary">
            <i class="fas fa-edit"></i>
        </a>
    </td>
</tr>
@endforeach
