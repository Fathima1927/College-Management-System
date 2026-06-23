<!DOCTYPE html>
<html>
<head>
    <title>Create Fee</title>
</head>
<body>

<h2>Create Fee Master</h2>

<form action="{{ route('fee-masters.store') }}" method="POST">
    @csrf

    <label>Department</label>
    <input type="text" name="department"><br><br>

    <label>Category</label>
    <input type="text" name="category"><br><br>

    <label>Fee Name</label>
    <input type="text" name="fee_name"><br><br>

    <label>Amount</label>
    <input type="number" step="0.01" name="amount"><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>