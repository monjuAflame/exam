@extends('student.layouts.master')

@section('content')

    <div class="col-12 bg-light rounded p-3">
        <div class="row">
            <div class="col-12 col-md-8 my-3">
                <div class="card border-0 shadow-sm">
                    <div class="card border-0 shadow-sm tip-box">
                        <div class="info-tab tip-icon rounded-lg" title="Useful Tips"><i class="bi bi-lightbulb p-2 text-white"></i></div>
                        <div class="card-body pl-5">
                            <h5 class="card-title font-weight-bold">Pro Tips</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            
                            <div class="exam-header-right">
                            @foreach($exam->batches as $batch)
                            
                                <a href="{{ route('student.exam.start', $exam->id) }}" type="button" class="btn btn-lg btn-warning px-5 w-100">Start Exam <i class="bi bi-play-fill"></i></a>
                            @endforeach
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
                                <p class="font-weight-bold"><i class="bi bi-question-square text-info mr-2"></i>Total Questions: <span class="text-danger">{{ $exam->question->count() }}</span></p>
                            @endforeach
                            </div>
                        
                    </div>
                </div>
            </div>

    </div>
@endsection