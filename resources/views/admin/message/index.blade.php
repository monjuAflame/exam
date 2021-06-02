@extends('admin.layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />

    

@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Message</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Message</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
@endsection


@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="card-header">
            {{ __('Message List') }}
            <a href="{{ route('sms.create') }}" class='btn btn-primary btn-sm float-right'>Create Message</a>            
            </div>

            <div class="card-body">
                <table id="message-table" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Student ID</th>
                            <th>Message</th>
                            <th>Send By</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>HSC 1ST</td>
                            <td>SAT,MON,WED</td>
                            <td>0001,0002</td>
                            <td>Hey, Oi Tora Taka Dis Nai Keno. Taratari Taka Pata.</td>
                            <td>Abbas(admin)</td>
                            <td>12-01-2021 12:55:12</td>
                            <td class='text-center'>
                                <a href="" class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
                            </td>
                        </tr>
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
            $('#message-table').DataTable({
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