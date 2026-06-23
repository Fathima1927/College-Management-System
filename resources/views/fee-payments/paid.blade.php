<!DOCTYPE html>
<html>
<head>
    <title>Paid Fees</title>
</head>
<body>

<h2>Paid Fees</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Student</th>
        <th>Fee</th>
        <th>Amount</th>
        <th>Status</th>
    </tr>

    @foreach($payments as $payment)
    <tr>
        <td>{{ $payment->student_name }}</td>
        <td>{{ $payment->fee_name }}</td>
        <td>{{ $payment->amount }}</td>
        <td>{{ $payment->status }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>