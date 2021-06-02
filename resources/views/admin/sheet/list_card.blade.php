<div class="card">
    <div class="card-header">
        <strong>{{ __('Sheet List') }}</strong>
    </div>

    <div class="card-body">
        <table id="sheet-list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Course</th>
                    <th>Sheet Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sheets as $sheet)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sheet->course != null ? $sheet->course->name : 'N/A' }}</td>
                    <td>{{ $sheet->name }}</td>
                    <td class='text-center'>
                        <a href="{{ route('sheet.edit', $sheet->id) }}" class='btn btn-default btn-sm'><i
                                class="fa fa-edit fa-xs blue"></i></a>
                        @if ($sheet->isDeletable)
                        <form action="{{ route('sheet.destroy', $sheet->id) }}" method="POST"
                            id="delete{{ $sheet->id }}" style="display: none">@csrf</form>
                        <a href=""
                            onclick="event.preventDefault();document.querySelector('#delete{{ $sheet->id }}').submit();"
                            class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
                            
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