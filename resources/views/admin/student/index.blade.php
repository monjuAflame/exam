@extends('admin.layouts.master')

@section('css')
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />



@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Student</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Student</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
@endsection


@section('content')



<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-md-8 mt-2">
                <form action="#" id="student-filter-form" method="POST">
                    <table>
                        <tr>
                            <td><label>Filter Option</label></td>
                            <td></td>
                            <td>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="" selected disabled>Select Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <select name="batch_id" id="batch_id" class="form-control">
                                    <option value="" selected disabled>Select Batch</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-4 mt-2">
                <div>
                    <a href="{{ route('student.create') }}" class='btn btn-primary float-right'>Create Student</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <div class="student-list-table">
                    <table id="student-list" class="table table-striped table-bordered dt-responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th>Enrolled Course</th>
                                <th>Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="filter-student">

                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <a
                                        href="{{ route('student.show', $student->student_id) }}">{{ $student->user->first_name . ' ' . $student->user->last_name }}</a>
                                </td>
                                <td>{{ $student->user->phone }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{!! implode('<br>', $student->user->enrolledCoursesNames) ?: 'N/A' !!}</td>
                                <td>{!! implode('<br>', $student->user->enrolledBatchesNames) ?: 'N/A' !!}</td>
                                <td>
                                    N/A
                                    {{--<a href="" class='btn btn-default btn-sm'><i class="fa fa-edit fa-xs blue"></i></a>
                                    <form action="" method="POST" id="delete" style="display: none">@csrf</form>
                                    <a href="" onclick="event.preventDefault();document.querySelector('#delete').submit();" class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>--}}

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> --}}

<script src='https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js'></script>
{{-- <script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js'></script> --}}
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script> --}}
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js'></script>
{{-- <script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js'></script>  --}}
<script>
    $(document).ready( function () {
            $('#student-list').DataTable({
                 "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": true,
                  "responsive": true,
                  dom: 'Bfrtip',
                //   initComplete:  function (settings, json) {
                //     $('button').removeClass('dt-button');
                //     $('.dt-buttons').addClass('btn-group flex-wrap');
                //     $('.buttons-colvis').addClass('dropdown-toggle');
                //     $('.dt-button-collection').child().addClass('dropdown-menu');
                    
                //   },
                  buttons: {
                    buttons: [
                            { extend: 'copy', className: 'btn btn-secondary' },
                            //{ extend: 'csv', className: 'btn btn-secondary' },
                            //{ extend: 'excel', className: 'btn btn-secondary' },
                            { extend: 'pdf', className: 'btn btn-secondary' },
                            //{ extend: 'print', className: 'btn btn-secondary' }
                        ]
                  }
            });

            $("#course_id").change(function(e){
                var course_id = $(this).val();
                var batch = $('#batch_id');
                $(batch).empty();
                $.get("{{ route('course.getBatch') }}", {course_id:course_id}, function(data){
                    $.each(data,function(i,pro){
                        $(batch).append($('<option/>',{
                            value : pro.id,
                            text  : pro.name
                        }));
                    });
                });
                showCourseInfo();
            });

            $("#batch_id").change(function(){
                showCourseInfo();
            });

            function showCourseInfo(){
                var data = $('#student-filter-form').serialize();
                $.get("{{ route('student.filter') }}", data ,function(data){
                    $('#filter-student').empty().append(data);
                })
            }



        });
</script>

@endsection