@extends('admin.layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />

    

@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Sheet</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Sheet</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
@endsection


@section('content')
	<div class="col-md-12">
        @include('admin.sheet.list_card')
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
            $('#sheet-list').DataTable({
                 "paging": true,
                  "lengthChange": true,
                  "searching": false,
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