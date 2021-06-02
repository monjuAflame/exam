@extends('admin.layouts.master')

@section('css')
<link href="{{ asset('assets/css/jquery-weekdays.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/wickedpicker.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css"/>

<style>
    label {
        font-size: 12px;
    }
</style>

@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Batch</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Batch</li>
    </ol>
</div>
@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header"><strong>{{ __('Create Batch') }}</strong>
            <span class="red"><b> ** Required</b></span>
        </div>

        <form action="{{ route('batch.store') }}" method="POST">
            @csrf
        <div class="card-body">

            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ session('message') }}
            </div>
            @endif

            
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Batch Name</label><span class="red">**</span>
                        <input type="text" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                            placeholder="Batch Name" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="course_id">Select Course</label><span class="red">**</span>
                        <select name="course_id" id="course_id"
                            class="form-control @error('course_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Select Course</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="id_prefix">ID Prefix</label><span class="red">**</span>
                        <input type="text" value="{{ old('id_prefix') }}"
                            class="form-control @error('id_prefix') is-invalid @enderror" name="id_prefix" id="id_prefix"
                            placeholder="P1MXX" required>
                        @error('id_prefix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>                    

                    <div class="col-md-6 mt-3">
                        <label for="weekdays">Select Days</label>
                        <div id="weekdays"> </div>
                        <input type="hidden" class="form-control @error('days') is-invalid @enderror" name="days"
                            id="days">
                        @error('weekdays')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="start_time">Start Time</label>
                        <input type="text" id="start_time" autocomplete="off" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror" />
                        @error('start_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="end_time">End Time</label>
                        <input type="text" id="end_time" autocomplete="off" name="end_time"
                            class="form-control @error('end_date') is-invalid @enderror" />
                        @error('end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary float-right" value="Create">
        </div>
        </form>
    </div>

</div>
<div class="col-md-12">
    @include('admin.batch.card_list')
</div>
@endsection


@section('js')
<script src="{{ asset('assets/js/jquery-weekdays.min.js') }}"></script>
<script src="{{ asset('assets/js/wickedpicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

<script>
    $(document).ready(function(){

            // day picker
            $('#weekdays').weekdays({
                listClass: 'weekdays-list',
                itemClass: 'weekdays-day',
                itemSelectedClass : 'weekday-selected',
                days: ["Sat","Sun","Mon","Tue","Wed","Thu","Fri"]
            });
            $('.weekdays-list .weekdays-day').click(function(e){
                var days = [];
                days = $('#weekdays').selectedDays();
                var day = days.toArray();
                $('#days').val(day);
            });
            
            
            // time
            $('#start_time').clockpicker({
                autoclose: true,
                twelvehour: true
            });
            $('#end_time').clockpicker({
                autoclose: true,
                twelvehour: true
            });


        });
</script>

@endsection