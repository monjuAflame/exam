@extends('admin.layouts.master')

@section('css')
<style type="text/css">
	.student-avatar{
		height: 200px;
		padding-left: 3px;
		padding-right: 1px;
		border: 1px solid #ccc;
		background: #eee;
		width: 100%;
		margin: 0 auto;
	}
	.avatar input {
		display: none;
	}
	.avatar{
		width: 200px;
		height: 140px;
		border-radius: 100%;
	}
	.btn-browse{
		background-repeat: repeat-x;
		border-color: #ccc;
		padding: 5px;
		text-align: center;
		background: #eee;
		border-bottom: 1px solid #ccc;
	}
    .personal-info, .coaching-info, .academic-info {
        background: white;
        box-shadow: 0px 0px 20px -10px black;
        padding: 10px;
        border-radius: 10px;
        margin: 0 0 20px 0;
    }
    .form-group label span, .red{
        color: red;
    }

</style>
@endsection

@section('page-title')
            <div class="col-12">
                <h3 class="page-header dark"><i class="fa fa-list-alt"></i> Student</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item dark"><i class="fa fa-home"></i> Home</li>
                    <li class="breadcrumb-item dark"><i class="fa fa-list-alt"></i> Student</li> 
                    <li class="breadcrumb-item dark"><i class="fa fa-edit"></i> Create</li>                
                </ol>
            </div>
        
@endsection


@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Student Registration') }}</div>

            <form action="{{ route('student.store') }}" method="POST">
                @csrf
            <div class="card-body">

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('message') }}
                    </div>
                @endif

                <div class="row personal-info">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Address">
                                        Personal Information
                                        <span class="red"><b>** Required</b></span>
                                    </label>
                                        <hr/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name <span>**</span></label>
                                    <input type="text" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name"  autocomplete="name" autofocus required>
                                    @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" autocomplete="last_name" autofocus>
                                    @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <fieldset>
                                        <label>Gender <span>**</span></label>
                                        <table style="width: 100%; margin-top: 5px">
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input type="radio" {{ old('gender') == 'male' || old('gender') != 'female' ? 'checked' : ''}} name="gender" id="gender" value="male" > Male
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input type="radio" {{ old('gender') == 'female' ? 'checked' : ''}} name="gender" id="gender" value="female"> Female
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone">Phone Number <span>**</span></label>
                                    <input type="text" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone Number"  autocomplete="phone" autofocus required>
                                    @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>     
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email">E-mail <span>**</span></label>
                                    <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="E-mail"  autocomplete="email" autofocus required>
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password">Password <span>**</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"  autocomplete="password" autofocus required>
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password <span>**</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"  autocomplete="confirm-password" autofocus required>
                                    @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guardian_name">Guardian Name</label>
                                    <input type="text" value="{{ old('guardian_name') }}" class="form-control @error('guardian_name') is-invalid @enderror" name="guardian_name" id="guardian_name" placeholder="Guardian Name"  autocomplete="guardian_name" autofocus>
                                    @error('guardian_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guardian_phone">Guardian Phone</label>
                                    <input type="text" value="{{ old('guardian_phone') }}" class="form-control @error('guardian_phone') is-invalid @enderror" name="guardian_phone" id="guardian_phone" placeholder="Guardian Phone"  autocomplete="guardian_phone" autofocus>
                                    @error('guardian_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address"  autocomplete="address" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group form-group-login">
                            <table style="margin: 0 auto">
                                <thead>
                                    <tr class="info">
                                        <th style="text-align: center">
                                            {{ sprintf('%05d',100+1) }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="avatar">
                                            <img class="img-responsive student-avatar" id="showAvatar" src="{{ asset('images/user.jpg') }}" alt=" "/>
                                            <input type="file" name="avatar" id="avatar" accept="image/*">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; background: #ddd;">
                                            <input type="button" name="browse_file" id="browse_file" class="form-control btn-browse" value="Browse">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>--}}
                </div>

                <div class="row coaching-info">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Address">
                                Coaching Information 
                            </label>
                                <hr/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="course_id">Course <span>**</span></label>
                            <select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id" required>
                                <option selected disabled value="">Select Course</option>
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="batch_id">Batch <span>**</span></label>
                            <select class="form-control @error('batch_id') is-invalid @enderror" name="batch_id" id="batch_id" required>
                                <option selected disabled value="">Select Batch</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>                                    
                                @endforeach
                            </select>
                            @error('batch_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admission_id">Admission Type <span>**</span></label>
                            <select class="form-control @error('admission_id') is-invalid @enderror" name="admission_id" id="admission_id" required>
                                {{--<option selected disabled value="">Select Type</option>--}}
                                {{--<option value="{{ App\Models\Course::ADMISSION_TYPE_MONTHLY }}">Monthly</option>--}}
                                <option value="{{ App\Models\Course::ADMISSION_TYPE_ADMISSION }}" selected>Admission</option>
                            </select>
                            @error('admission_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="student_id">Student ID</label>
                            <input type="text" value="{{ old('student_id') }}" class="form-control @error('student_id') is-invalid @enderror" name="student_id" id="student_id" value="{{ sprintf('%05d',100+1) }}"  autocomplete="student_id" readonly>
                            @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>--}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="session">Session <span>**</span></label>
                            <input type="text" value="{{ old('session') }}" class="form-control @error('session') is-invalid @enderror" name="session" id="session" placeholder="2020-2021" autocomplete="session" required>
                            @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="date">Admission Date</label>
                            <input type="text" class="form-control" name="date" id="date" value="{{ '17-12-1995' }}" readonly>
                        </div>
                    </div>--}}
                </div>

                <div class="row academic-info">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Address">
                                Academic Information (SSC)
                            </label>
                                <hr/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ssc_academic_name">Academic Name</label>
                            <input type="text" value="{{ old('ssc_academic_name') }}" class="form-control @error('ssc_academic_name') is-invalid @enderror" id="ssc_academic_name" name="ssc_academic_name" placeholder="Academic Name"  autocomplete="academic_name">
                            @error('ssc_academic_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ssc_board">Board</label>
                            <input type="text" value="{{ old('ssc_board') }}" class="form-control @error('ssc_board') is-invalid @enderror" id="ssc_board" name="ssc_board" placeholder="Board"  autocomplete="ssc_board">
                            @error('ssc_board')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ssc_group">Group</label>
                            <input type="text" value="{{ old('ssc_group') }}" class="form-control @error('ssc_group') is-invalid @enderror" id="ssc_group" name="ssc_group" placeholder="Group"  autocomplete="ssc_group">
                            @error('ssc_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ssc_passing_year">Passing Year</label>
                            <input type="text" value="{{ old('ssc_passing_year') }}" class="form-control @error('ssc_passing_year') is-invalid @enderror" id="ssc_passing_year" name="ssc_passing_year" placeholder="Passing Year"  autocomplete="ssc_passing_year">
                            @error('ssc_passing_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="ssc_gpa">GPA</label>
                            <input type="text" value="{{ old('ssc_gpa') }}" class="form-control @error('ssc_gpa') is-invalid @enderror" id="ssc_gpa" name="ssc_gpa" placeholder="GPA"  autocomplete="ssc_gpa">
                            @error('ssc_gpa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ssc_roll">Roll</label>
                            <input type="text" value="{{ old('ssc_roll') }}" class="form-control @error('ssc_roll') is-invalid @enderror" id="ssc_roll" name="ssc_roll" placeholder="Roll"  autocomplete="ssc_roll">
                            @error('ssc_roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                        </div>
                    </div>
                </div>

                <div class="row academic-info">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Address">
                                Academic Information (HSC)
                            </label>
                                <hr/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hsc_academic_name">Academic Name</label>
                            <input type="text" value="{{ old('hsc_academic_name') }}" class="form-control @error('hsc_academic_name') is-invalid @enderror" id="hsc_academic_name" name="hsc_academic_name" placeholder="Academic Name"  autocomplete="academic_name">
                            @error('hsc_academic_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hsc_board">Board</label>
                            <input type="text" value="{{ old('hsc_board') }}" class="form-control @error('hsc_board') is-invalid @enderror" id="hsc_board" name="hsc_board" placeholder="Board"  autocomplete="hsc_board">
                            @error('hsc_board')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hsc_group">Group</label>
                            <input type="text" value="{{ old('hsc_group') }}" class="form-control @error('hsc_group') is-invalid @enderror" id="hsc_group" name="hsc_group" placeholder="Group"  autocomplete="hsc_group">
                            @error('hsc_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hsc_passing_year">Passing Year</label>
                            <input type="text" value="{{ old('hsc_passing_year') }}" class="form-control @error('hsc_passing_year') is-invalid @enderror" id="hsc_passing_year" name="hsc_passing_year" placeholder="Passing Year"  autocomplete="hsc_passing_year">
                            @error('hsc_passing_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="hsc_gpa">GPA</label>
                            <input type="text" value="{{ old('hsc_gpa') }}" class="form-control @error('hsc_gpa') is-invalid @enderror" id="hsc_gpa" name="hsc_gpa" placeholder="GPA"  autocomplete="hsc_gpa">
                            @error('hsc_gpa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="hsc_roll">Roll</label>
                            <input type="text" value="{{ old('hsc_roll') }}" class="form-control @error('hsc_roll') is-invalid @enderror" id="hsc_roll" name="hsc_roll" placeholder="Roll"  autocomplete="hsc_roll">
                            @error('hsc_roll')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block float-right">Create</button>
            </div>
            </form>
        </div>
		
	</div>
@endsection


@section('js')


   <script>
       $(document).ready(function(){
          
        //=======for student image=======
		$('#browse_file').on('click',function(){
			$('#avatar').click();
		})
		$('#avatar').on('change',function(e){
			showfile(this,'#showAvatar')
		});
		function showfile(fileInput,img,showfile){
			if (fileInput.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e){
					$(img).attr('src', e.target.result);
				}
				reader.readAsDataURL(fileInput.files[0]);
			}
			$(showfile).text(fileInput.files[0].name);
		}
       })
   </script>

@endsection