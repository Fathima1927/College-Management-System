<h2>Create Receipt</h2>

<form action="{{ route('fee-receipts.store') }}" method="POST">
    @csrf

    Student Name:
    <input type="text" name="student_name">
    <br><br>

    Fee Name:
    <input type="text" name="fee_name">
    <br><br>

    Amount:
    <input type="number" name="amount">
    <br><br>

    Payment Date:
    <input type="date" name="payment_date">
    <br><br>

    <button type="submit">
        Generate Receipt
    </button>
</form>