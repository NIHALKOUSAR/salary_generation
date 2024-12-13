<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Salary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="my-4">Edit Salary Record</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('salary.update', $salary->employee_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="gross">Gross Salary</label>
            <input type="number" class="form-control" id="gross" name="gross" value="{{ $salary->gross }}" required>
        </div>

        <div class="form-group">
            <label for="net_salary">Net Salary</label>
            <input type="number" class="form-control" id="net_salary" name="net_salary" value="{{ $salary->net_salary }}" required>
        </div>

        <div class="form-group">
            <label for="total_deduction">Total Deduction</label>
            <input type="number" class="form-control" id="total_deduction" name="total_deduction" value="{{ $salary->total_deduction }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
