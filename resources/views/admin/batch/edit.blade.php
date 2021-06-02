@extends('admin.layouts.master')

@section('css')
<link href="{{ asset('assets/css/jquery-weekdays.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/wickedpicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet"/>

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
        <li class="breadcrumb-item"><a href="{{ route('batch.create') }}">Batch</a></li>
        <li class="breadcrumb-item active">Update</li>
    </ol>
</div>
@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header"><strong>{{ __('Update Batch') }}</strong>
            <span class="red"><b> ** Required</b></span>
            <a href="{{ route('batch.create') }}" class='btn btn-primary btn-sm float-right'>Batch List</a>            

        </div>
        <form action="{{ route('batch.update', $batch->id) }}" method="POST">
            @csrf
        <div class="card-body">

            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ session('message') }}
            </div>
            @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Batch Name</label><span class="red">**</span>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                            value="{{ old('name') ?? $batch->name }}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="course_id">Select Course</label><span class="red">**</span>
                        <select name="course_id" id="course_id"
                            class="form-control @error('course_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $batch->course_id==$course->id ? 'selected' : ''}}>{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-4" style="display: none;">
                        <label for="id_prefix">ID Prefix</label><span class="red">**</span>
                        <input type="text" value="{{ old('id_prefix') ?? $batch->id_prefix }}"
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
                        <input type="text" class="form-control @error('days') is-invalid @enderror" name="days"
                            id="days" value="{{ $batch->days != null ? implode(',', json_decode($batch->days)) : 'N/A' }}" readonly>
                        @error('weekdays')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="start_time">Start Time</label>
                        <input id="start_time" autocomplete="off" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') ?? (date('H:iA', strtotime($batch->start_time)) ?: '') }}" name="start_time">
                        @error('start_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="end_time">End Time</label>
                        <input type="text" autocomplete="off" id="end_time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') ?? (date('H:iA', strtotime($batch->end_time)) ?: '') }}" />
                        @error('end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary float-right" value="Update">
        </div>
        </form>
    </div>

</div>
@endsection


@section('js')
<script src="{{ asset('assets/js/jquery-weekdays.min.js') }}"></script>
<script src="{{ asset('assets/js/wickedpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-clockpicker.min.js') }}"></script>
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