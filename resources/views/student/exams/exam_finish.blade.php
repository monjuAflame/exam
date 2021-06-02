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
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h5 class="card-title text-success"><i class="bi bi-check2-circle text-info mr-2"></i> Congratulations ! Exam Taken Successfully </h5>
                                        <h6 class="card-subtitle text-warning mb-4"><i class="align-middle mr-2" data-feather="info"></i>We will publish your result soon.</h6>
                                    </div>
                                </div>
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
                        <p class="font-weight-bold"><i class="bi bi-hourglass-split text-info mr-2"></i>End Time: <span class="text-danger">{{ $end_time}} <i class="bi bi-stopwatch"></i></span></p>
                        <p class="font-weight-bold"><i class="bi bi-question-square text-info mr-2"></i>Total Questions: <span class="text-danger">{{ $exam->question->count() }}</span></p>
                        <p class="font-weight-bold"><i class="bi bi-check2-circle text-info mr-2"></i>Answered Questions: <span class="text-danger">{{ $total_ans }}</span></p>
                        @endforeach
                    </div>
                    <div class="exam-header-right">
                        <a href="{{ route('student.profile') }}" class="btn btn-lg btn-success px-5 w-100" id="examStart">Successfully Taken <i class="bi bi-play-fill"></i></a>
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