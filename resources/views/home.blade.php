@extends('admin.layouts.master')

@section('page-title')
    <div class="col-sm-6">
                <h1 class="dark">Dashboard</h1>
    </div>
    {{--<div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Layout</a></li>
            <li class="breadcrumb-item active">Fixed Layout</li>
        </ol>
    </div>--}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Students</span>
                    <span class="info-box-number">
                      {{ $student_count }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-flag"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Courses </span>
                    <span class="info-box-number">{{ $course_count }}</span>
                  </div>
                </div>
              </div>
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Batches</span>
                <span class="info-box-number">{{ $batch_count }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SMS Balance</span>
                <span class="info-box-number">5</span>
              </div>
            </div>
          </div>
        {{--<div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <img style="height: auto; width: 100%" src="{{ asset('images/svg/welcome.svg') }}">
                    <br>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>--}}

    </div>
</div>
@endsection
