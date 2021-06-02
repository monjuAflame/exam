@extends('exam.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">All Tests</h1>
        <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addShowBatchesModal">Schedule An Exam</button> -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center">All Exams
                        </h5>
                        <h6 class="card-subtitle text-muted">Exam ready for schedule</h6>
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="align-middle mr-2" data-feather="check-circle"></i> {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Test Name</th>
                                    <th>Programe</th>
                                    <th>Course</th>
                                    <th>Duration(min)</th>
                                    <th>Scheduled For</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examsUnschedule as $unscheduleExam)
                                <tr>
                                    <td>{{ $unscheduleExam->title }}</td>
                                    <td>{{ $unscheduleExam->course->courseCategory->name }}</td>
                                    <td>{{ $unscheduleExam->course->name }}</td>
                                    <td>{{ intval($unscheduleExam->duration_in_minutes/60) . "hr(s) " . intval($unscheduleExam->duration_in_minutes%60) . "min(s)" }}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addShowBatchesModal{{ $unscheduleExam->id }}">Schedule An Exam</button>
                                    </td>

                                    <td class="table-action">
                                        <a href="{{ route('exam.edit', $unscheduleExam->id) }}"><i class="align-middle text-primary" data-feather="edit"></i></a>
                                        <a href="{{ route('exam.destroy', $unscheduleExam->id) }}" class="ml-2" onclick="return confirm('Are you sure?')"><i class="align-middle text-danger" data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
    <div class="modal fade" id="addShowBatchesModal{{ $unscheduleExam->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Batches</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form id="assignExam{{ $unscheduleExam->id }}" method="POST" action="{{route('exam.schedule')}}">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3 col-12">
                                <select class="form-control" name="schedule_exam" style="width: 100%" required>
                                    <option value="{{ $unscheduleExam->id }}" >{{ $unscheduleExam->title }}</option>
                                </select>
                            </div>
                            <div class="form-group m-0 col-12">
                                <label class="form-label sr-only">Select2 Multiple</label>
                                <div class="d-flex">
                                    <select class="form-control" name="schedule_batches" multiple style="width: 100%" required>
                                        @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3 col-12 col-md-6">
                                <label class="form-label d-block">Exam Date</label>
                                <input type="date" name="schedule_date" required>
                            </div>
                            <div class="form-group mt-3 col-12 col-md-6">
                                <label class="form-label d-block">Exam Time</label>
                                <input type="time" name="schedule_time" required>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="assignExam{{ $unscheduleExam->id }}" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
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
                                    <th>Subject</th>
                                    <th>Duration(min)</th>
                                    <th>Start Time</th>
                                    <th>Batches</th>
                                    <th>Marks</th>
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
                                           
                            @if($start_date_time <= $c && $end_time >= $c) 
                                    <tr>
                                        <td><a href="{{ route('exam.questions.show', $exam->id) }}">{{ $exam->title }}</a></td>
                                        <td>{{ $exam->course->courseCategory->name }}</td>
                                        <td>{{ $exam->course->name }}</td>
                                        <td>{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</td>
                                        <td>{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</td>
                                        <td>{{ $batch->name }}</td>
                                        <td>{{ $exam->total_marks }}</td>
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

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center">Scheduled Tests</h5>
                        <h6 class="card-subtitle text-muted">These tests are scheduled</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Test Name</th>
                                    <th>Programe</th>
                                    <th>Subject</th>
                                    <th>Duration(min)</th>
                                    <th>Start Time</th>
                                    <th>Batch</th>
                                    <th>Marks</th>
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
                                           
                            @if($start_date_time >= $c && $end_time >= $c) 
                                    <tr>
                                        <td><a href="{{ route('exam.questions.show', $exam->id) }}">{{ $exam->title }}</a></td>
                                        <td>{{ $exam->course->courseCategory->name }}</td>
                                        <td>{{ $exam->course->name }}</td>
                                        <td>{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</td>
                                        <td>{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</td>
                                        <td>{{ $batch->name }}</td>
                                        <td>{{ $exam->total_marks }}</td>
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
                        <h5 class="card-title d-flex align-items-center">Already Held Tests</h5>
                        <h6 class="card-subtitle text-muted">These tests are already taken</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Test Name</th>
                                    <th>Programe</th>
                                    <th>Subject</th>
                                    <th>Duration(min)</th>
                                    <th>Started</th>
                                    <th>Batch</th>
                                    <th>Marks</th>
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
                                @if($end_time <= $c)
                                    <tr>
                                        <td><a href="{{ route('exam.questions.show', $exam->id) }}">{{ $exam->title }}</a></td>
                                        <td>{{ $exam->course->courseCategory->name }}</td>
                                        <td>{{ $exam->course->name }}</td>
                                        <td>{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</td>
                                        <td>{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</td>
                                        <td>{{ $batch->name }}</td>
                                        <td>{{ $exam->total_marks }}</td>
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