@extends('student.layouts.master')

@section('content')

    <div class="col-12 bg-light rounded p-3">

        

        <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center">All Results
                            <div class="spinner-grow spinner-grow-sm text-success ml-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Test Name</th>
                                <th>Programe</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Duration</th>
                                <th>Start Time</th>
                                <th>Marks</th>
                                <th>Action</th>
                                {{--<th>Participants</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                @foreach($exam->batches as $batch)
                                @php 
                                    $start_date_time = $batch->schedule->start_date_time;
                                    $c = date('Y-m-d H:i:s', time());
                                    $end_time = date('Y-m-d H:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));
                                    $examinee = $exam->examinee->where('user_id', auth::user()->id)->first();
                                @endphp
                                @if($examinee)
                                @if($end_time <= $c)
                                @if($batch->id == $user->enrolments[0]->batch_id && $exam->course_id == $user->enrolments[0]->course_id)
                                    <tr>
                                        <td><a href="#">{{ $exam->title }}</a></td>
                                        <td>{{ $exam->course->courseCategory->name }}</td>
                                        <td>{{ $exam->course->name }}</td>
                                        <td>{{ $batch->name }}</td>

                                        <td>{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</td>
                                        <td>{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</td>
                                        <td>{{ $exam->total_marks }}</td>
                                        <td>
                                            @if($exam->result_publish==1)
                                            <a href="{{ route('student.result.details', $batch->schedule->exam_id) }}">Result</a>
                                            @else
                                                Not Publish
                                            @endif
                                        </td>
                                        {{--<td>218</td>--}}
                                    </tr>
                                @endif
                                @endif
                                @endif
                                @endforeach

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>

@endsection