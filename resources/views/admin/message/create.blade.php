@extends('admin.layouts.master')

@section('css')
    
@endsection

@section('page-title')
	<div class="col-sm-5">
        <h1 class="dark">Message</h1>
    </div>
    <div class="col-sm-7">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Message</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>

@endsection


@section('content')
	<div class="col-md-12">
        <messsage-create></message-create>
	</div>
@endsection
@section('js')
<script>

</script>
@endsection