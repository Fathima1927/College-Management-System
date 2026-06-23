<h2>Fee Receipts</h2>

<a href="{{ route('fee-receipts.create') }}">
    Generate Receipt
</a>

<table border="1">

<tr>
    <th>Receipt No</th>
    <th>Student</th>
    <th>Fee</th>
    <th>Amount</th>
</tr>

@foreach($receipts as $receipt)

<tr>
    <td>{{ $receipt->receipt_number }}</td>
    <td>{{ $receipt->student_name }}</td>
    <td>{{ $receipt->fee_name }}</td>
    <td>{{ $receipt->amount }}</td>
</tr>

@endforeach

</table>