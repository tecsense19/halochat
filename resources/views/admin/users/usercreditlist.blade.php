<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Credit</th>
            <th>Debit</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if(count($credit_debit) > 0)
            @foreach($credit_debit as $key => $credit_debit_1)
                @foreach($credit_debit_1->creditdebit as $usersListcredit)
                    <tr>
                        <td>{{ ($key + 1) }}</td>
                        <td>{{ $usersListcredit->name }}</td>
                        <td>{{ isset($credit_debit_1->credit) ? $credit_debit_1->credit : '-' }}</td>
                        <td>{{ isset($credit_debit_1->debit) ? $credit_debit_1->debit : '-' }}</td>
                        <td>{{ date('Y-m-d', strtotime($credit_debit_1->credit_debit_date)) }}</td>
                    </tr>
                @endforeach
            @endforeach
        @else
            <tr scope="row" style="text-align: center;">
                <td colspan="6">No credit debit Found.</td>
            </tr>
        @endif
    </tbody>
</table>
{!! $credit_debit->links('pagination') !!}