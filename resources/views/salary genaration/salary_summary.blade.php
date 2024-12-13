<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Generation Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="my-4">Salary Generation Records</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Basic</th>
                <th>Gross Salary</th>
                <th>Net Salary</th>
                <th>Total Deduction</th>
                <th>Generated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaryDetails as $salary)
                <tr>
                    <td>{{ $salary->employee_name }}</td>
                    <td>{{ $salary->basic }}</td>
                    <td>{{ $salary->gross }}</td>
                    <td>{{ $salary->net_salary }}</td>
                    <td>{{ $salary->total_deduction }}</td>
                    <td>{{ $salary->month }}</td>
                    <td>
                        <a href="{{ route('salary.edit', $salary->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('salary.destroy', $salary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

