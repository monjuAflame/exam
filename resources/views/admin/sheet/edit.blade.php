@extends('admin.layouts.master')

@section('css')
    
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Sheet</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sheet.create') }}">Sheet</a></li>
        <li class="breadcrumb-item active">Update</li>
    </ol>
</div>
        
@endsection


@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="card-header"><strong>{{ __('Update Sheet') }}</strong> <span class="red"><b>** Required</b></span>
                <a href="{{ route('sheet.create') }}" class='btn btn-primary btn-sm float-right'>Sheet List</a>
            </div>
            <form action="{{ route('sheet.update', $sheet->id) }}" method="POST">
            @csrf
            <div class="card-body">

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('message') }}
                    </div>
                @endif

                    
                <div class="row">
                    <div class="col-md-12">
                            <label for="name">Sheet Name</label> <span class="red">**</span>
                            <input type="text" value="{{ $sheet->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    
                    <div class="col-md-6">
                            <label for="course_id">Course</label> <span class="red">**</span>
                            <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $sheet->course_id == $course->id? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
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
   

@endsection