<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container mt-5">
    <h2 class="text-center">Employee Details</h2>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($employees) > 0)
        <form action="{{ route('generate.salary') }}" method="POST">
            @csrf
            <input type="text" name="month" value="{{ \Carbon\Carbon::parse($selectMonth)->format('Y-m-d') }}">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>IFSC Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_employees[]" value="{{ $employee->id }}">
                            </td>
                            <td>{{ $employee->employee_name }}</td>
                            <td>{{ $employee->account_number }}</td>
                            <td>{{ $employee->bank_name }}</td>
                            <td>{{ $employee->ifsc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Generate Salary Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Generate Salary</button>
            </div>
        </form>
    @else
        <p>No employee details found.</p>
    @endif
</div>
</body>
</html>
 
<script>
    $(document).ready(function() {
         
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    });
</script>