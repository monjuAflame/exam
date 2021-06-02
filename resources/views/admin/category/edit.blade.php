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
        <li class="breadcrumb-item"><a href="{{ route('category.create') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</div>
        
@endsection


@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="card-header"><strong>{{ __('Edit Category') }}</strong> <span class="red">** Required</span>
            <a href="{{ route('category.create') }}" class='btn btn-primary btn-sm float-right'>Category List</a>            
                
            </div>
            <form action="{{ route('category.update', $category->id) }}" method="POST">
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
                            <label for="name">Category Name</label> <span class="red">**</span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $category->name }}" required>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    
                </div>
                
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary float-left" value="Update">
            </div>
            </form>
        </div>
		
	</div>
@endsection


@section('js')
   

@endsection