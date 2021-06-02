<div class="card">
    <div class="card-header">
        <strong>{{ __('Batch List') }}</strong>
    </div>

    <div class="card-body">
        <table id="batch-list" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>ID Prefix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($batches as $batch)
                <tr>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->course->name }}</td>
                    <td>{{ $batch->formattedDays }}</td>
                    <td>{{ $batch->formattedTime }}</td>
                    <td>{{ $batch->id_prefix }}</td>
                    <td class='text-center'>
                        <a href="{{ route('batch.edit', $batch->id) }}" class='btn btn-default btn-sm'><i
                                class="fa fa-edit fa-xs blue"></i></a>
                        @if ($batch->isDeletable)
                            <form action="{{ route('batch.destroy', $batch->id) }}" method="POST"
                                id="delete{{ $batch->id }}" style="display: none">@csrf</form>
                            <a href=""
                                onclick="event.preventDefault();document.querySelector('#delete{{ $batch->id }}').submit();"
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