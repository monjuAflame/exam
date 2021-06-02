@extends('admin.layouts.master')

@section('css')
<style>
    label {
        font-size: 12px;
    }
</style>
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Course</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('course.create') }}">Course</a></li>
        <li class="breadcrumb-item active">Update</li>
    </ol>
</div>
        
@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ __('Update Course') }} <span class="red"><b>** Required</b></span>
            <a href="{{ route('course.create') }}" class='btn btn-primary btn-sm float-right'>Course List</a>

        </div>
        <form action="{{ route('course.update', $course->id) }}" method="POST">
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
                        <label for="name">Course Name</label><span class="red">**</span>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ $course->name }}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">

                        <label for="course_category_id">Course Category</label><span class="red">**</span>
                        <select name="course_category_id" id="course_category_id"
                            class="form-control @error('course_category_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Select</option>
                            @foreach ($course_cats as $cat)
                                <option value="{{ $cat->id }}" {{ $course->course_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('course_category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <label for="fee">Course Fee</label><span class="red">**</span>
                        <input type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" id="fee" value="{{ $course->fee }}" required>
                        @error('fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="code">Course Code [optional]</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            id="code" value="{{ $course->code }}">
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="duration_in_weeks">Course Duration (In Weeks)[Optional]</label>
                        <input type="text" class="form-control @error('duration_in_weeks') is-invalid @enderror" name="duration_in_weeks" id="duration_in_weeks" value="{{ $course->duration_in_weeks }}">
                        @error('duration_in_weeks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="total_class">Total Class [Optional]</label>
                        <input type="text" id="total_class" name="total_class"
                            class="form-control @error('total_class') is-invalid @enderror"  value="{{ $course->total_class }}"/>
                        @error('total_class')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="total_exam">Total Exams [Optional]</label>
                        <input type="text" id="total_exam" name="total_exam"
                            class="form-control @error('total_exam') is-invalid @enderror" value="{{ $course->total_exam }}" />
                        @error('total_exam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Update</button>
        </div>

        </form>

    </div>

</div>
@endsection


@section('js')


@endsection