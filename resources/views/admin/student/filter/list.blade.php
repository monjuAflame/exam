@foreach ($students as $student)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td> <a href="{{ route('student.show', $student->student_id) }}">{{ $student->user->first_name . ' ' . $student->user->last_name }}</a></td>
    <td>{{ $student->user->phone }}</td>
    <td>{{ $student->user->email }}</td>
    <td>{{ $student->student_id }}</td>
    <td>{!! implode('<br>', $student->user->enrolledCoursesNames) ?: 'N/A' !!}</td>
    <td>{!! implode('<br>', $student->user->enrolledBatchesNames) ?: 'N/A' !!}</td>
    <td>
        <a href="" class='btn btn-default btn-sm'><i class="fa fa-edit fa-xs blue"></i></a>
            <form action="" method="POST" id="delete" style="display: none">@csrf</form>
            <a href="" onclick="event.preventDefault();document.querySelector('#delete').submit();" class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
            
    </td>
</tr>
@endforeach