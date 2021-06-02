@extends('exam.layouts.master')


@section('content')
    
<main class="content single-result-page">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><small class="mr-1">Detailed Results For</small> {{ $exam->title }}</h1>

        <div class="row">


            <div class="col-12">
                <div class="card single-result-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title d-flex align-items-center m-0">{{ $exam->title }}</h5>
                            <ul class="list-inline m-0">
                                <li class="list-inline-item">
                                    <a href="#" class="print" onclick="window.print()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"><i class="align-middle" data-feather="printer"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download"><i class="align-middle" data-feather="download-cloud"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Share"><i class="align-middle" data-feather="share"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped single-result-table">
                            <thead class="thead-light">
                        
                            <tr>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Score</th>
                                <th>Started</th>
                                <th>Time Spent (In Minutes)</th>
                                    @foreach($exam->question as $question)
                                            <!-- {{logger($question)}} -->
                                        <th>{{ $loop->iteration }}</th>
                                    @endforeach
                            </tr>
                            </thead>
                            <tbody>
                           
                            
                                @foreach($exam->examinee as $examinee)
                                <tr>
                                    <td><a href="{{ route('student.show',$examinee->user_id) }}" target="_blank">{{ $examinee->user->first_name }}<i class="align-middle ml-2" data-feather="external-link"></i></a></td>
                                    <td>{{ $examinee->user->studentProfile->student_id }}</td>
                                    @php 
                                        
                                       
                                    @endphp
                                    
                                    <td>{{ number_format($examinee->total_right_answer*100/$exam->question->count(),2) }}%<br>({{ $examinee->total_right_answer }}/{{$exam->question->count()}})</td>
                                   

                                    <td>{{ date('Y-m-d h:i A', strtotime($examinee->start_time))  }}</td>
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

                                    @foreach($exam->question as $question)
                                    @php $options = json_decode($question->options) @endphp
                               
                                        @foreach($answers as $answer)
                                            @if($examinee->user_id == $answer->user_id && $question->id == $answer->question_id)
                                                    
                                                @if($question->mcq_answer_index == $answer->answer)
                                                    <td><i class="align-middle text-success" data-feather="check-circle"></i></td>
                                                @else
                                                    <td><i class="align-middle text-danger" data-feather="x-circle"></i></td>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    
                                    
                                </tr>
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