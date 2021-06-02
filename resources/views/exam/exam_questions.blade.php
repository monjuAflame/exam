@extends('exam.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><small class="mr-2">Question Paper For</small>{{ $exam->title }}</h1>

        <div class="row">
            <div class="col-12">
                <div class="card question-paper">
                    <div class="card-header pb-0">
                        <div class="question-paper-info d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap">
                            <div class="test-title-status d-flex align-items-center flex-wrap flex-md-nowrap">
                                <h2 class="card-title m-0 question-paper-title">{{ $exam->title }}</h2>
                                <!-- <h4 class="rounded-pill border-danger text-danger border my-2 my-md-0 ml-0 ml-md-2 px-2 py-1">Taken:<span class="ml-2 small">Jan 12, 2021; 11:30AM</span></h4> -->
                                @php
                                    $batch = $exam->batches[0]->schedule; 
                                    $start_date_time = $batch->start_date_time;
                                    $c = date('Y-m-d H:i:s', time());
                                    $end_time = date('Y-m-d H:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));  
                                @endphp 
                                @if($start_date_time <= $c && $end_time <= $c)
                                <h4 class="rounded-pill border-success text-success border my-2 my-md-0 ml-0 ml-md-2 px-2 py-1">Taken:<span class="ml-2 small">{{ $start_date_time }}</span></h4>
                                @elseif($start_date_time <= $c && $end_time >= $c)
                                <h4 class="rounded-pill border-success text-success border my-2 my-md-0 ml-0 ml-md-2 px-2 py-1">Taken:<span class="ml-2 small">Currently Going On</span></h4>
                                @else
                                <h4 class="rounded-pill border-danger text-danger border my-2 my-md-0 ml-0 ml-md-2 px-2 py-1">Taken:<span class="ml-2 small">Not Taken</span></h4>
                                @endif

                            </div>
                            <div class="question-paper-actions border rounded p-2">
                                <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top" title="Edit Test"><i class="align-middle text-primary" data-feather="edit"></i></a>
                                <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top" title="Test Settings"><i class="align-middle text-primary" data-feather="settings"></i></a>
                                <span class="border-right mx-2 pt-1 pb-1"></span>
                                <a href="#" class="mx-2" data-toggle="tooltip" data-placement="top" title="Delete Test"><i class="align-middle text-danger" data-feather="trash-2"></i></a>
                            </div>
                        </div>
                        <div class="question-paper-info bd-callout bd-callout-primary bg-light d-flex flex-wrap">
                            <h5 class="p-2 font-weight-bold">Subject:<span class="ml-2 mr-1 font-weight-light">{{ $exam->title }}</span></h5>
                            <h5 class="p-2 font-weight-bold">Duration:<span class="ml-2 mr-1 font-weight-light">{{ $exam->duration_in_minutes }}</span>minutes</h5>
                            <h5 class="p-2 font-weight-bold">Total Marks:<span class="ml-2 mr-1 font-weight-light">{{ $exam->total_marks }}</span></h5>
                            <h5 class="p-2 font-weight-bold d-flex">Batches:<span class="ml-2 mr-1 font-weight-light">
                                    <!-- <ul class="list-inline m-0">
                                        <li class="list-inline-item"><a href="#">Batch 1</a></li>
                                        <li class="list-inline-item"><a href="#">Batch 2</a></li>
                                        <li class="list-inline-item"><a href="#">Batch 3</a></li>
                                    </ul> -->
                            @if($batch)
                                
                                <h4 class="text-success"><span class="ml-2 small">{{ $exam->batches[0]->name }}</span></h4>
                            @else
                            <h4 class="text-danger"><span class="ml-2 small">Batch Not Shedule !</span></h4>
                            @endif

                            </h5>
                            <h5 class="p-2 font-weight-bold">Exam Description:<span class="ml-2 mr-1 font-weight-light">{{ $exam->intro_text }}</span></h5>
                        </div>
                    </div>
                    <div class="card-body">
                    @foreach ($questions as $question)
                            @if($question->type=='mcq')
                            <div class="mcq-set px-0 px-md-5 py-0 py-md-2">
                                <div class="question-mcq-individual d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                    <div class="d-flex flex-start">
                                        <span class="font-weight-bolder text-dark lead mr-4">Q.{{ $loop->iteration }}</span>
                                        <p class="m-0 font-weight-bolder text-dark lead">{{$question->title}}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="m-0 pr-2">Marks:</p>
                                        <p class="m-0 px-4 py-2 bg-light rounded">{{$question->mark}}</p>
                                    </div>
                                </div>

                                <div class="question-mcq-choices">
                                @php $options = json_decode($question->options) @endphp
                                
                                
                                @foreach($options->options as $okey => $option)
                                    <div class="custom-control custom-radio mx-5 my-3">
                                        <input type="radio" id="answer{{$okey[0]}}" value="{{$okey}}" name="answer{{$question->id}}" class="custom-control-input" {{ (int) $okey[0] == $question->mcq_answer_index ? "checked"  : ''}}>
                                        <label class="custom-control-label" for="answer{{$okey[0]}}">{{$option}}</label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            @else

                            <div class="writing-set px-0 px-md-5 py-0 py-md-2">
                                <div class="question-fib-individual d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                    <div class="d-flex flex-start">
                                        <span class="font-weight-bolder text-dark lead mr-4">Q.2</span>
                                        <p class="m-0 font-weight-bolder text-dark lead">What is the capital of Bangladesh?</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="m-0 pr-2">Marks:</p>
                                        <p class="m-0 px-4 py-2 bg-light rounded">1</p>
                                    </div>
                                </div>

                                <div class="explanation-message form-group col-12">
                                    <div class="bd-callout bd-callout-primary">
                                        <p>This is an explanation text for this question</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection