@extends('admin.layouts.master')

@section('css')
    <style>
       .personal-info, .course-info, .sheet-info, .fee-info, .payment-info, .search-student {
            box-shadow: 0px 0px 20px -12px black;
            border-radius: 10px;
            padding: 20px 10px 20px;
        }
        
    </style>
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Payment</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Payment</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
</div>
        
@endsection


@section('content')
	<div class="col-md-12">
    
        <div class="card">
            <div class="card-header">{{ __('Search Student') }}</div>

            <div class="card-body">
                <form action="{{ route('student.search') }}" method="POST">
                    @csrf
                    <div class="row search-student">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_id">Student ID</label>	                            
                                <input type="text" value="{{ old('student_id') }}" class="form-control @error('student_id') is-invalid @enderror" name="student_id" id="student_id"  autocomplete="student_id" required>

                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">     
                                <button type="submit" class="btn btn-primary" style="margin-top:31px;">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>

	</div>
@endsection


@section('js')


@endsection