<div class="card">
    <div class="card-header text-center">
        <strong>CTG Coaching</strong>
        <p style="margin-bottom:0;">Income Satement</p>
        <p style="margin-bottom:0;">
            From <b>{{ date('d-m-Y', strtotime($form)) }}</b> To <b>{{ date('d-m-Y', strtotime($to)) }}</b>
            
        </p>
    </div>

    <div class="card-body">
        <table id="income-statement" class="table table-striped table-bordered dt-responsive" style="font-size:12px;">
           
            <thead>
                <tr class="text-align">
                    <th style="width: 5%">#</th>
                    <th style="width: 70%">Description</th>
                    <th>Taka</th>
                    <th>Taka</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td></td>
                    <td><b>Income</b></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($incomes as $income)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $income->first_name.' '.$income->last_name }}-{{ $income->student_id }}-{{ $income->course }}-{{ $income->batch }}</th>
                        <th>{{ $income->amount }}</th>
                        <th></th>
                    </tr>
                @endforeach
                
                <tr class="text-right">
                    <td></td>
                    <td><b>Total Income</b></td>
                    <td></td>
                    <td><b>{{ number_format($total_income,2) }}</b></td>
                </tr>
                <tr class="text-center">
                    <td></td>
                    <td><b>Expense</b></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($expenses as $expense)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $expense->date }}</th>
                        <th>{{ $expense->total_expense }}</th>
                        <th></th>
                    </tr>
                @endforeach
                <tr class="text-right">
                    <td></td>
                    <td><b>Total Expense</b></td>
                    <td></td>
                    <td><b>({{ number_format($total_expense,2) }})</b></td>
                </tr>
                <tr class="text-right">
                    <td></td>
                    <td><b>{{ $net_profit > 0 ? 'Net Profit':'Net Loss' }}</b></td>
                    <td></td>
                    <td style="border-bottom: 2px solid #000"><b>{{ number_format($net_profit,2) }}</b></td>
                </tr>
            </tbody>
        </table>
</div>
<div class="card-footer">
</div>
</div>
@section('js')
<script type="text/javascript">
    
</script>

@endsection