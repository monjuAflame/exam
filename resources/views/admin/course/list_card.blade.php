<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Course List') }}</strong>
        </div>

        <div class="card-body">
            {{--@if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ session('message') }}
        </div>
        @endif--}}
        <table id="course-list" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Fee</th>
                    <th>Duration</th>
                    <th>Class</th>
                    <th>Exam</th>
                    <th>Batches</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code ?? 'N/A' }}</td>
                    <td>{{ $course->courseCategory->name ?? 'N/A' }}</td>
                    <td>{{ 'BDT ' . $course->fee }}</td>
                    <td>{{ $course->duration_in_weeks ?? 'N/A' }}</td>
                    <td>{{ $course->total_class ?? 'N/A' }}</td>
                    <td>{{ $course->total_exam ?? 'N/A' }}</td>
                    <td>{!! $course->batches()->count() > 0 ?
                        $course->batches->implode('name', '<br />') : 'N/A'
                        !!}</td>
                    <td class='text-center'>
                        <a href="{{ route('course.edit', $course->id) }}" class='btn btn-default btn-sm'><i
                                class="fa fa-edit fa-xs blue"></i></a>
                        @if ($course->isDeletable)
                        <form style="display: none;" id="delete{{$course->id}}" method="POST"
                            action="{{ route('course.destroy', $course->id) }}">@csrf</form>
                        <a href=""
                            onclick="event.preventDefault();document.querySelector('#delete{{ $course->id }}').submit();"
                            class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <div class="card-footer">

    </div>
</div>

</div>