@extends('student.layouts.master')

@section('content')

			<div class="col-md-2 d-md-block"></div>
			<div class="col-12 col-md-7">
				<div class="rounded bg-light p-3">
					<h2 class="h3 mb-3">Profile</h2>

                    @include('student.profiles.personal')
                    @include('student.profiles.coaching')
                    @include('student.profiles.academic')
                    @include('student.profiles.payment')

				</div>
			</div>
			<div class="col-12 col-md-3"></div>

@endsection