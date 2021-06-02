@extends('admin.layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />

    

@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Payment</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Payment</li>
    </ol>
</div>
@endsection


@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>{{ __('Payment List') }}</strong>
            </div>

            <div class="card-body">
                @if (session()->has('payment_message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('payment_message') }}
                    </div>
                @endif
                {{--<div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="filter_search">Filter Search</label>
                            <select name="filter_search" id="filter_search" class="form-control">
                                <option value="" disabled>Select</option>
                                <option value="0" selected>All</option>
                                <option value="1">CONFIRM</option>
                                <option value="1">UNCONFIRM</option>
                            </select>
                        </div>
                    </div>
                </div>--}}
                <table style="font-size: 12px;" id="payment-list" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                    <thead>
                        <tr>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Amount</th>
                                <th>Student Name</th>
                                <th>Phone</th>
                                <th>Student Id</th>
                                <th>Course</th>
                                <th>Batch</th>
                                <th>Verified</th>
                                <th>Received/Confirmed by</th>
                                <th>Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr data-id="" id="sfeeId" class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->amount . ' (' . ucwords($payment->method) . ')' }}</td>
                                <td><a href="{{ route('student.show', $payment->user->studentProfile->student_id) }}">{{ $payment->user->first_name }}</a></td>
                                <td>{{ $payment->user->phone }}</td>
                                <td>{{ $payment->user->studentProfile->student_id }}</td>
                                <td>{{ $payment->enrolment->course->name }}</td>
                                <td>{{ $payment->enrolment->batch->name }}</td>
                                <td>{{ $payment->confirmed ? 'Yes' : 'No' }}</td>
                                <td>{{ $payment->confirmed ? $payment->receivedUser->first_name : 'N/A' }}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($payment->created_at)) }}</td>
                                <td>
                                    
                                        <a href="{{ route('payment.invoice', $payment->id) }}" target="_blank" class="btn btn-sm" style="display:block; overflow:hidden">
                                            <i class="fa indigo fa-print"></i>
                                        </a>   
                                    @if ($payment->confirmed == false)  
                                        <form id="paymentConfirm{{ $payment->id }}" action="{{ route('payment.confirm', $payment->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                        </form>                                            
                                    @endif
                                </td>
                            </tr>                             
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="card-footer">
                
            </div>
        </div>
		
	</div>
@endsection


@section('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<script src='https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js'></script>
    <script>
        $(document).ready( function () {
            $('#payment-list').DataTable({
                 "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
                  dom: 'Bfrtip',
                  initComplete:  function (settings, json) {
                    $('button').removeClass('dt-button');
                    $('.dt-buttons').addClass('btn-group flex-wrap');
                    $('.buttons-colvis').addClass('dropdown-toggle');
                    $('.dt-button-collection').child().addClass('dropdown-menu');
                    
                  },
                  buttons: {
                    buttons: [
                            //{ extend: 'copy', className: 'btn btn-secondary' },
                            //{ extend: 'csv', className: 'btn btn-secondary' },
                            //{ extend: 'excel', className: 'btn btn-secondary' },
                            { extend: 'pdf', className: 'btn btn-secondary' },
                            //{ extend: 'print', className: 'btn btn-secondary' }
                        ]
                  }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        } );
    </script>

@endsection