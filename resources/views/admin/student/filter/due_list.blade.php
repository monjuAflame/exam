@foreach ($students as $student)
    @if($student->due!=0)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('student.show', $student->student_id) }}">{{ $student->first_name . ' ' . $student->last_name }}</a></td>
            <td>{{ $student->student_id }}</td>
            <td>{{ $student->course }}</td>
            <td>{{ $student->batch }}</td>
            <td>{{ $student->due }}</td>
        </tr>
    @endif
@endforeach