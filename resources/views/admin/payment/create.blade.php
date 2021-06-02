@extends('admin.layouts.master')

@section('css')
<style>
    .personal-info,
    .course-info,
    .sheet-info,
    .fee-info,
    .payment-info,
    .search-student {
        box-shadow: 0px 0px 20px -12px black;
        border-radius: 10px;
        padding: 20px 10px 20px;
    }

    .student-img {
        height: 150px;
        width: 150px;
        margin: 50px auto;
        border-radius: 100%;
        background: #001f3f;
        box-shadow: 0px 0px 31px -12px black;
    }

    .student-img img {
        width: 100%;
        height: 100%;
        padding: 1px;
        border-radius: 50%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        white-space: nowrap;
    }

    th {
        padding: 3px;
    }

    tr,
    td,
    th {
        padding: 2px 2px 3px;
    }

    tbody.last-row>tr:last-child {
        background: #ffc;
    }

    tbody.first-row>tr:first-child {
        background: #ffc;

    }

    thead>th {
        border: 1px solid;
    }

    .list-student-fee>thead>tr>th {
        border: 1px solid;
        padding: 5px 5px;

    }

    table tr>td>input {
        height: 30px;
        width: 100%;
        padding: 5x;

    }

    select {
        height: 30px;
        width: 130px;
    }

.list-group-item {
    border-bottom: 1px solid #e9ecef;
    padding: 8px 0;
    border-left: none;
    border-right: none;
    border-top: none;
}

ul.list-group {
    box-shadow: 0px 0px 12px -7px black;
    border-radius: 10px;
    padding: 10px 20px;
}

.list-group-item:first-child {
    padding: 0;
    text-align: center;
    border-bottom: 1px solid #007bff;
}
.list-group-item:first-child label{
    font-size: 14px;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.list-group-item label {
    font-size: 13px;
    margin-bottom: 0;
    letter-spacing: .5px;
}

.list-group-item:last-child {
    border-bottom: none;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc;
    border-color: #367fa9;
    padding: 1px 10px;
    color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    margin-right: 5px;
    color: rgba(255,255,255,0.7);
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
}

</style>
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Profile & Payment</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
    </ol>
</div>

@endsection


@section('content')
<div class="col-md-12">

    <div class="card">
        <div class="card-header">{{ __('Student Details') }}</div>

        <div class="card-body">
            {{--<form action="" method="POST">
                    @csrf
                    <div class="row search-student">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_id">Student ID</label>	                            
                                <input type="text" class="form-control {{ session()->has('error_message') ? 'is-invalid' : ''}}"
            name="student_id" id="student_id" value="{{ sprintf('%05d',100+1) }}" autocomplete="student_id" required>

            @if (session()->has('error_message'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ session('error_message') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="admission_type">Admission Type</label>
            <select name="admission_type" id="admission_type"
                class="form-control @error('student_id') is-invalid @enderror" required>
                <option selected disabled value="">Select</option>
                <option value="0">Monthly</option>
                <option value="1">Admission</option>
            </select>

            @error('admission_type')
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
</form>--}}
<div class="row personal-info mt-4">
    <div class="col-md-3">
        <div class="row">
            <div class="col-12 text-center search-student-info mb-1">
                <div class="student-img mb-3">
                    <img src="/images/svg/student.svg" alt="student-img" class="img-responsive">
                </div>
                <h3>{{ $student->fullName }}</h3>
                {{--<b>17-12-1995</b>--}}
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"
                        value="{{ old('first_name') ?? $user->first_name }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" value="{{ old('last_name') ?? $user->last_name }}" name="last_name"
                        id="last_name" class="form-control" value="Raihan" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone') ?? $user->phone }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control"
                        value="{{ old('email') ?? $user->email }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_name">Guardian Name</label>
                    <input type="text" name="guardian_name" id="guardian_name" class="form-control"
                        value="{{ old('guardian_name') ?? $student->guardian_name ?? '' }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="guardian_phone">Guardian Phone</label>
                    <input type="text" name="guardian_phone" id="guardian_phone" class="form-control"
                        value="{{ old('guardian_phone') ?? $student->guardian_phone ?? '' }}" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ old('address') ?? $student->address ?? '' }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row course-info mt-4">

    <div class="col-md-2">
        <div class="form-group">
            <label for="student_id">Studen ID</label>
            <input type="text" name="student_id" id="student_id" class="form-control"
                value="{{ old('student_id') ?? $student->student_id ?? '' }}" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="course_id">Course</label>
            <select name="course_id" id="course_id" class="form-control">
                @foreach ($enrolments as $enrolment)
                    <option selected disabled value="{{ $enrolment->course->id }}">{{ $enrolment->course->name }}</option>                    
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="batch_id">Batch</label>
            <select name="batch_id" id="batch_id" class="form-control">
                @foreach ($enrolments as $enrolment)
                    <option selected disabled value="{{ $enrolment->batch->id }}">{{ $enrolment->batch->name }}</option>                    
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="admission_type">Admission Type</label>
            <input type="text" name="admission_type" id="admission_type" class="form-control" value="Admission"
                readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="register_date">Registration</label>
            <input type="text" name="register_date" id="register_date" class="form-control" value="{{ date('d-m-Y', strtotime($user->created_at)) }}" readonly>
        </div>
    </div>

</div>

    <div class="row sheet-info mt-4" id="profile-sheet-section">
        <div class="col-12">
            <b>Sheets</b>
            <hr>
            @if (session()->has('sheet_message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i> {{ session('sheet_message') }}
                </div>
            @endif
        </div>
        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-12">
                    @if ($attached_sheets->count() == 0)
                        <p class="text-center">This student doesn't have any sheets</p>
                    @else
                        <table id="payment-list" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Course</th>
                                    <th>Sheet Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attached_sheets as $attach_sheet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attach_sheet->courseName }}</td>
                                        <td>{{ $attach_sheet->name }}</td>
                                        <td>
                                            @hasanyrole('admin')
                                            <form action="{{ route('sheet.detach', $user->id) }}" method="POST" id="delete{{ $user->id }}" style="display: none">
                                                @csrf
                                                <input type="hidden" name="detach_sheet_id" value="{{ $attach_sheet->id }}">
                                            </form>
                                            
                                            <a href="" onclick="event.preventDefault();document.querySelector('#delete{{ $user->id }}').submit();" class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
                                            @else
                                            N/A
                                            @endhasanyrole
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="table-repsonsive">
                        <span id="error"></span>
                        <form action="{{ route('sheet.attach', $user->id) }}" method="POST">
                            <table class="table table-bordered" id="item_table">
                                <tr>
                                    <th>
                                        @csrf
                                        <select id="new_sheet_id" class="form-control select2" name="new_sheet_id[]" multiple="multiple" data-placeholder="Select Sheet(s)" style="width: 100%;" required>
                                            @foreach ($sheets as $sheet)
                                                <option value="{{ $sheet->id }}">{{ $sheet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('new_sheet_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror                                    
                                    </th>
                                </tr>
                            </table>
                                <button type="submit" class="btn btn-success float-right"><span class="fa fa-plus"> Add Selected Sheets</span></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
@if ($latest_enrolment)
    <form method="POST" action="{{ route('payment.store', $latest_enrolment->pivot->id) }}">
        @csrf
        <div class="row fee-info mt-4" id="payment-section">
            <div class="col-12">
                <b>Payment</b>
                <hr>
                @if (session()->has('payment_message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('payment_message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <table class="table-fee">
                    <tr>
                        <td><label>Course Fee (BDT)</label></td>
                        <td>
                            <input type="text" id="fee" value="{{ $latest_enrolment->fee }}" class="form-control" readonly>
                        </td>
                    </tr>
    				@hasanyrole('admin')
                    <tr>
                        <td><label>Discount (BDT)</label></td>
                        <td>
                            <input type="text" name="discount" value="{{ old('discount') ?? 0 }}" id="discount" class="form-control" placeholder="Discount" required>
                        </td>
                    </tr>
                    @endhasanyrole
                    <tr>
                        <td><label>Current Payment (BDT)</label><span class="red">**</span></td>
                        <td>
                            <input type="text" value="{{ old('paid') ?? 0 }}" name="paid" id="paid" class="form-control" placeholder="Current Payment" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Remarks</label></td>
                        <td>
                            <input type="text" value="{{ old('remarks') }}" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-md-4 offset-md-1">
                <div class="form-group">
                    <ul class="list-group">
                        <li class="list-group-item align-item-center">
                        <label>Payment Summary</label> 
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                        <label>Course Name</label> 
                            <span>{{ $latest_enrolment->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                        <label>Course Fee</label> 
                            <span id="course_fee">{{ 'BDT ' . $latest_enrolment->fee }}</span>
                        </li>
                        @if(auth()->user()->hasRole('admin') || $latest_enrolment->pivot->discount > 0)
                            <li class="list-group-item d-flex justify-content-between align-item-center">
                            <label>Discount</label> 
                                <span id="course_discount">{{ 'BDT ' . $latest_enrolment->pivot->discount }}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                        <label>Net Payable</label> 
                        @php($payable = $latest_enrolment->fee - $latest_enrolment->pivot->discount)
                            <span id="course_after_discount">{{ 'BDT ' .  $payable }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                        <label>Total Paid</label> 
                            <span id="course_total_paid">{{ 'BDT ' . App\Models\Payment::getTotalPaidAmount($latest_enrolment->pivot->id) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                            <label>Due</label>
                            <span id="course_due">{{ 'BDT ' . ($payable - App\Models\Payment::getTotalPaidAmount($latest_enrolment->pivot->id)) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <input type="submit" id="btn-go" name="btn-go" class="btn btn-sm btn-primary btn-payment save-payment"
                    value="Save">

                <input type="button" onclick="this.form.reset()" class="btn btn-default pull-right btn-reset btn-sm"
                    value="Reset">
            </div>

        </div>
    </form> 
@else
<div class="row fee-info mt-4" id="payment-section">
    <p><b>This student didn't enroll to any course.</b></p>
</div>
@endif

<div class="row payment-info mt-4">
    <div class="col-12">
        <b>Payment List</b>
        <hr>
    </div>
    <div class="col-12">
        @foreach ($enrolments as $enrolment)
            {!! $loop->first ? '' : '<br/>' !!}
            <h6>
                Course: <strong>{{ $enrolment->course->name }}</strong>  
                
                @if ($enrolment->payments->count() > 0)
                    <a href="{{ route('payment.full-invoice', $enrolment->user_id) }}" title="Print Full Invoice" target="_blank" class="btn btn-sm">
                                            <i class="fa indigo fa-print"></i>
                                        </a>                
                @endif
            </h6>
            @if ($enrolment->payments->count() == 0)
                <p>No payment history was found for this course!</p>
                @continue
            @endif
            <div class="table-responsive">
                <table style="border-collapse: collapse;" class="table-hover table-bordered" id="list-student-fee">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Verified</th>
                            <th>Received/Verified by</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-student-fee">

                        @foreach ($enrolment->payments as $payment)
                            <tr data-id="" id="sfeeId" class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ ucwords($payment->method) }}</td>
                                <td>{{ $payment->confirmed ? 'Yes' : 'No' }}</td>
                                <td>{{ $payment->confirmed ? $payment->receivedUser->first_name : 'N/A' }}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($payment->created_at)) }}</td>
                                <td>
                                    @hasanyrole('admin')
                                        <a href="{{ route('payment.invoice', $payment->id) }}" title="Print Invoice" target="_blank" class="btn btn-sm">
                                            <i class="fa indigo fa-print"></i>
                                        </a> 
                                        @if ($payment->confirmed == false)
                                            <form id="paymentConfirm{{ $payment->id }}" action="{{ route('payment.confirm', $payment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                            </form>                                            
                                        @endif
                                    @else
                                        N/A
                                    @endhasanyrole
                                </td>

                                {{--<td style="text-align: center; width: 115px;">
                                    <a href="#" class="btn btn-success btn-xs stufee-edit" title="edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="" title="Print" target="_blank" class="btn btn-info btn-xs"><i
                                            class="fa fa-print"></i></a>

                                </td>--}}
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>

</div>
<div class="card-footer">
</div>
</div>

</div>
@endsection


@section('js')

@include ('admin.payment.script.calculate')

<script>

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            allowClear: true
        });

        $('.single-selectable-select2').select2({
            multiple: false
        });
    });
</script>


@endsection