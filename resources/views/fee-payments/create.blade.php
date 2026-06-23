<!DOCTYPE html>
<html>
<head>
    <title>Fee Payment</title>
</head>
<body>

<h2>Fee Payment</h2>

<form action="{{ route('fee-payments.store') }}" method="POST">
    @csrf

    <label>Student Name</label>
    <input type="text" name="student_name" required>
    <br><br>

    <label>Fee Name</label>
    <input type="text" name="fee_name" required>
    <br><br>

    <label>Amount</label>
    <input type="number" step="0.01" name="amount" required>
    <br><br>

    <label>Payment Mode</label>
    <select name="payment_mode">
        <option>Cash</option>
        <option>UPI</option>
        <option>Card</option>
        <option>Net Banking</option>
    </select>
    <br><br>

    <label>Status</label>
    <select name="status">
        <option>Paid</option>
        <option>Pending</option>
    </select>
    <br><br>

    <label>Payment Date</label>
    <input type="date" name="payment_date" required>
    <br><br>

    <button type="submit">Save Payment</button>

</form>

</body>
</html>