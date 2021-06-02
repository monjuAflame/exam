@extends('student.layouts.master')

@section('content')

<div class="col-12 bg-light rounded p-3">

    <div class="card border-0 shadow-sm tip-box">
        <div class="info-tab tip-icon rounded-lg" title="Useful Tips"><i class="bi bi-lightbulb p-2 text-white"></i></div>
        <div class="card-body pl-5">
            <h5 class="card-title font-weight-bold">Pro Tips</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 my-3">
            <div class="card border-0 shadow-sm">
                <div class="question-paper p-3">
                    <div class="question-paper-inner border rounded p-2">
                        <div class="questions question-1 mb-4" id="indivQuestion">
                            <div class="mcq-set px-0 px-md-5 py-0 py-md-2">
                                    @if($next_q_id==null)
                                    <div class="card border-0 shadow-sm tip-box mt-3 mb-4">
                                        <div class="card-body pl-5">
                                        <p class="card-text">This Is Your Last Question. Select Answer and Finish It.</p>
                                        </div>
                                    </div>
                                    @endif
                                <form action="{{ route('student.exam.question') }}" method="POST">
                                @csrf
                                <input type="hidden" name="next_q_id" value="{{ $next_q_id }}">
                                <input type="hidden" name="previous_q_id" value="{{ $previous_q_id }}">
                                <input type="hidden" name="current_q_id" value="{{ $question->id }}">
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <div class="question-mcq-individual d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                    <div class="d-flex flex-start">
                                        <span class="font-weight-bolder text-dark lead mr-4">Q.{{ $question->id }}</span>
                                        <p class="m-0 font-weight-bolder text-dark lead">{{$question->title}}</p>
                                    </div>
                                </div>

                                <div class="question-mcq-choices">
                                    @php $options = json_decode($question->options) @endphp


                                    @foreach($options->options as $okey => $option)
                                    <div class="custom-control custom-radio mx-5 my-3">
                                        <input type="radio" id="ans{{$okey}}" value="{{$okey}}" name="answer" class="custom-control-input">
                                        <label class="custom-control-label" for="ans{{$okey}}">{{$option}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="next-question">
                                    @if($next_q_id==null)
                                        <button type="submit" class="btn btn-success">Finish</button>
                                    @else
                                    <button type="submit" class="btn btn-primary">Next Question</button>
                                    @endif

                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 my-3">
            <div class="card border-0 shadow-sm">
                <div class="exam-info p-3">
                    <div class="exam-header-left">

                        @foreach($exam->batches as $batch)
                        <h2 class="h3 mb-3 font-weight-bold"><small class="text-muted">Exam on</small><br><span>Subject: {{ $exam->title }}<br> Programe: {{ $exam->course->courseCategory->name }}<br> Course: {{ $exam->course->name }}<br> Batch: @foreach($exam->batches as $batch){{ $batch->name }}@endforeach</span></h2>

                        <p class="font-weight-bold"><i class="bi bi-calendar3 text-info mr-2"></i>Exam Date: <span class="text-muted">{{ date('M d, Y H:i:s A', strtotime($batch->schedule->start_date_time)) }}</span></p>
                        <p class="font-weight-bold"><i class="bi bi-box text-info mr-2"></i>Total Marks: <span class="text-muted">{{ $exam->total_marks }}</span></p>
                        <p class="font-weight-bold"><i class="bi bi-stopwatch text-info mr-2"></i>Exam Duration: <span class="text-danger">{{ intval($exam->duration_in_minutes/60) . "hr(s) " . intval($exam->duration_in_minutes%60) . "min(s)" }}</span></p>
                        @php $start_date_time = $batch->schedule->start_date_time;
                                            $end_time = date('Y-m-d h:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));
                        @endphp
                        <p class="font-weight-bold"><i class="bi bi-hourglass-split text-info mr-2"></i>End Time: <span class="text-danger">{{ $end_time }} <i class="bi bi-stopwatch"></i></span></p>
                        <p class="font-weight-bold"><i class="bi bi-question-square text-info mr-2"></i>Total Questions: <span class="text-danger">{{ $exam->question->count() }}</span></p>
                        <p class="font-weight-bold"><i class="bi bi-check2-circle text-info mr-2"></i>Answered Questions: <span class="text-danger">{{ $total_ans }}</span></p>
                        @endforeach
                    </div>
                    <div class="exam-header-right">
                        <button type="button" class="btn btn-lg btn-danger px-5 w-100" id="examStart">Leave Exam <i class="bi bi-play-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function() {
        // $("#examStart").attr('disabled', false);
        // let exam_id = $("#exam_id").val();



        // load_question();

        // // $("#examStart").click(function() {
        // //     if (confirm('Are You Sure to Remove')) {
        // //         if (exam_id != '') {
        // //             // $(this).attr('disabled', true);
        // //             load_question(exam_id);
        // //         }
        // //     }
        // // });
        // $(document).on('click', '.next', function() {
        //     var question_id = $(this).attr('id');
        //     load_question(question_id);
        // });

        // $(document).on('click', '.previous', function() {
        //     var question_id = $(this).attr('id');
        //     load_question(question_id);
        // });

        // function load_question(question_id = '') {
        //     $.ajax({
        //         url: "/admin/students/exam/question/",
        //         type: "POST",
        //         data: {
        //             exam_id: exam_id,
        //             question_id: question_id
        //         },
        //         success: function(response) {
        //             $('#single_question_area').html(response);
        //             console.log(response);
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log(textStatus, errorThrown);
        //         }
        //     });
        // }




    });
</script>
@endsection