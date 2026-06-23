<!DOCTYPE html>
<html>
<head>
    <title>Fee Master</title>
</head>
<body>

<h2>Fee Master List</h2>

<a href="{{ route('fee-masters.create') }}">
    Add Fee
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Department</th>
        <th>Category</th>
        <th>Fee Name</th>
        <th>Amount</th>
    </tr>

    @foreach($fees as $fee)
    <tr>
        <td>{{ $fee->id }}</td>
        <td>{{ $fee->department }}</td>
        <td>{{ $fee->category }}</td>
        <td>{{ $fee->fee_name }}</td>
        <td>{{ $fee->amount }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>