@extends('exam.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">All Results</h1>

        <div class="row">


            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center">Results For All Tests</h5>
                        <h6 class="card-subtitle text-muted">Click on the tests names to view details</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped results-table">
                            <thead>
                                <tr>
                                    <th>Test Name</th>
                                    <th>Programe</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Test Taken</th>
                                    <th>Results Published</th>
                                    <th>Ouestions</th>
                                    <th>Total Marks</th>
                                    <th>Pass Marks</th>
                                    <th>Participants</th>
                                    {{---<th>Passed</th>
                                <th>Failed</th>---}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($exams as $exam)
                                @foreach($exam->batches as $batch)

                                @php
                                $start_date_time = $batch->schedule->start_date_time;
                                $c = date('Y-m-d H:i:s', time());
                                $end_time = date('Y-m-d H:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));
                                $answer = $answers->where('exam_id',$exam->id)->first();
                                @endphp

                                @if($start_date_time <= $c && $end_time <=$c) <tr>
                                    <td><a href="{{ route('exam.result.show', $exam->id) }}" target="_blank">{{ $exam->title }}<i class="align-middle ml-2" data-feather="external-link"></i></a></td>
                                    <td>{{ $exam->course->courseCategory->name }}</td>
                                    <td>{{ $exam->course->name }}</td>
                                    <td>{{ $batch->name }}</td>
                                    <td>{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</td>
                                    <td>
                                        @if($exam->result_publish==0)
                                        <a class="btn btn-primary btn-sm" href="{{ route('exam.results.publish', $exam->id) }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">Publish</a>
                                        <form id="logout-form" action="{{ route('exam.results.publish', $exam->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        @else
                                        Published
                                        @endif
                                    </td>
                                    <td>{{ $exam->question->count() }}</td>
                                    <td>{{ $exam->total_marks }}</td>
                                    <td>{{ $exam->passing_score }}</td>
                                    <td>{{ $exam->examinee->count() }}</td>
                                    {{---<td>84</td>
                                    <td>36</td>---}}
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center">Currently Going On
                            <div class="spinner-grow spinner-grow-sm text-success ml-2" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </h5>
                        <h6 class="card-subtitle text-muted">These tests are being held right now</h6>
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
                                    <th>Ouestions</th>
                                    <th>Total Marks</th>
                                    <th>Pass Marks</th>
                                    <th>Participants</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exams as $exam)
                                @foreach($exam->batches as $batch)
                                @php
                                $start_date_time = $batch->schedule->start_date_time;
                                $c = date('Y-m-d H:i:s', time());
                                $end_time = date('Y-m-d H:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));
                                @endphp

                                @if($start_date_time <= $c && $end_time>= $c)
                                    <tr>
                                        <td>{{ $exam->title }}</td>
                                        <td>{{ $exam->course->courseCategory->name }}</td>
                                        <td>{{ $exam->course->name }}</td>
                                        <td>{{ $batch->name }}</td>
                                        <td>{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</td>
                                        <td>{{ $exam->question->count() }}</td>
                                        <td>{{ $exam->total_marks }}</td>
                                        <td>{{ $exam->passing_score }}</td>
                                        <td>{{ $exam->examinee->count() }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>


@endsection