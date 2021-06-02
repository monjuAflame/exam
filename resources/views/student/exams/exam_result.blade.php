@extends('student.layouts.master')


@section('content')

                <div class="col-12 bg-light rounded p-3">


                    <div class="row">
                        <div class="col-12 col-md-8 my-3">
                            <div class="card border-0 shadow-sm">
                                <div class="exam-info p-3">
                                    <div class="exam-result-header">
                                        <h2 class="h3 mb-3 font-weight-bold"><small class="text-muted">Exam Results for</small><br><span>{{ $exam->title }} {{ $exam->course->courseCategory->name }}({{ $exam->course->name }})</span> <br><small class="text-muted">{{ $exam->batches[0]->name }}</small></h2>
                                        <p class="font-weight-bold"><i class="bi bi-calendar3 text-info mr-2"></i>Exam Taken: <span class="text-muted">{{ date('M d, Y', strtotime($exam->batches[0]->schedule->start_date_time) ) }}</span></p>
                                        <p class="font-weight-bold"><i class="bi bi-box text-info mr-2"></i>Total Marks: <span class="text-muted">{{ $exam->total_marks }}</span></p>
                                        <p class="font-weight-bold"><i class="bi bi-stopwatch text-info mr-2"></i>Exam Duration: <span class="text-danger">{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</span></p>
                                        <p class="font-weight-bold"><i class="bi bi-question-square text-info mr-2"></i>Total Questions: <span class="text-danger">{{ $exam->question->count() }}</span></p>
                                    </div>
                                </div>

                                <div class="individual-result p-3">
                                    <h4 class="font-weight-bold text-center mb-4">Your Result:</h4>
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <div class="individual-result-inner rounded-pill bg-faded-green">
                                                <p class="font-weight-bold m-0 px-3 py-2"><i class="bi bi-hourglass-split text-info mr-2"></i>Time Spent: <span class="text-danger">
                                                    @php 
                                                        $examinee = $exam->examinee->where('user_id', auth::user()->id)->first();

                                                        $start = \Carbon\Carbon::parse($examinee->start_time);
                                                        $end = \Carbon\Carbon::parse($examinee->end_time);
                                                        $hours = $end->diffInHours($start);
                                                        $minutes = $end->diffInMinutes($start);
                                                        $seconds = $end->diffInSeconds($start);

                                                    @endphp
                                                    {{ $hours . ':' . $minutes . ':' . $seconds ." sec"}}
                                                </span></p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="individual-result-inner rounded-pill bg-faded-green">
                                                <p class="font-weight-bold m-0 px-3 py-2"><i class="bi bi-check2-circle text-info mr-2"></i>Answered Right: <span class="text-danger">{{ $examinee->total_right_answer }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="individual-result-inner rounded-pill bg-faded-green">
                                                <p class="font-weight-bold m-0 px-3 py-2"><i class="bi bi-trophy text-info mr-2"></i>Mark: <span class="text-danger">{{ $examinee->marks }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 my-3">
                            <div class="card border-0 shadow-sm">
                                <div class="leaderboard p-3">
                                    <h4 class="font-weight-bold"><i class="bi bi-trophy"></i> Leaderboard</h4>

                                    <table class="table table-striped border">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student</th>
                                            <th scope="col">Marks</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exam->examinee as $examinee)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @php $user = \App\Models\User::where('id', $examinee->user_id)->first() @endphp
                                                    {{$user->first_name}}
                                                </td>
                                                <td>{{ $examinee->marks }}</td>
                                                <td>
                                                @php 
                                                        $start = \Carbon\Carbon::parse($examinee->start_time);
                                                        $end = \Carbon\Carbon::parse($examinee->end_time);
                                                        $hours = $end->diffInHours($start);
                                                        $minutes = $end->diffInMinutes($start);
                                                        $seconds = $end->diffInSeconds($start);

                                                    @endphp
                                                    {{ $hours . ':' . $minutes . ':' . $seconds ." sec"}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                        
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>




                </div>

@endsection