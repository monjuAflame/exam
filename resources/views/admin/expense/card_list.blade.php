<div class="card">
    <div class="card-header">
        <strong>{{ __('Expanses List') }}</strong>
    </div>

    <div class="card-body">
        <table id="batch-list" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Date of Expense</th>
                    {{-- <th>Made By</th> --}}
                    <th>Amount of Expense</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dailyExpenses as $dailyExp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y H:i' , strtotime($dailyExp->date)) }}</td>
                    {{-- <td>{{ $dailyExp->user->first_name }}</td> --}}
                    <td>{{ $dailyExp->amount }}</td>
                    <td>{{ $dailyExp->description }}</td>
                    <td class='text-center'>
                        <a href="{{ route('expense.edit', $dailyExp->id) }}" class='btn btn-default btn-sm'><i class="fa fa-edit fa-xs blue"></i></a>
                            <form action="{{ route('expense.destroy', $dailyExp->id) }}" method="POST"
                                id="delete{{ $dailyExp->id }}" style="display: none">@csrf</form>
                            <a href="" onclick="event.preventDefault();document.querySelector('#delete{{ $dailyExp->id }}').submit();" class='btn btn-default btn-sm'>
                                <i class="fa fa-trash fa-xs red"></i>
                            <a>                            
                       
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
    <div class="card-footer">

    </div>
</div>