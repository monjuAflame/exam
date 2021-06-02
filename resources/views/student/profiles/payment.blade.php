            <h5 class="mt-4 text-capitalize">Payment History</h5>
            <div class="card border-0 bg-white shadow-sm p-3 my-2">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Paid Amount</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student->payments as $payment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->method }}</td>
                        <td>{{ date('M d, Y', strtotime($payment->created_at)) }}</td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
