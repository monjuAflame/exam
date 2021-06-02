@extends('admin.layouts.master')

@section('css')
    
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Category</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
    </ol>
</div>
        
@endsection


@section('content')
	<div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('Create Category') }} <span class="red">** Required</span></div>
            <form action="{{ route('category.store') }}" method="POST">
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
                            <label for="name">Category Name</label><span class="red">**</span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Course Name" required>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    
                </div>
                
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary float-left" value="Create">
            </div>
            </form>
        </div>
		
    </div>
    <div class="col-md-6">    
        @include('admin.category.list_card')
    </div>
@endsection


@section('js')
   

@endsection