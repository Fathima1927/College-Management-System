<!DOCTYPE html>
<html>
<head>
    <title>Fee Dashboard</title>
</head>
<body>

<h1>Fee Dashboard</h1>

<h3>Total Collection</h3>
<p>₹ {{ $totalCollection }}</p>

<h3>Pending Amount</h3>
<p>₹ {{ $pendingAmount }}</p>

<h3>Paid Students</h3>
<p>{{ $paidStudents }}</p>

<hr>

<h2>Recent Payments</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Student</th>
        <th>Fee</th>
        <th>Amount</th>
        <th>Status</th>
    </tr>

    @foreach($recentPayments as $payment)
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