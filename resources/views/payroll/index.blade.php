<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom table styling */
        .table th, .table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #d1ecf1;
        }

        .table th {
            font-size: 14px;
            font-weight: bold;
        }

        .table td {
            font-size: 13px;
        }

        .btn {
            font-size: 12px;
            padding: 5px 10px;
        }

        .container {
            margin-top: 30px;
        }

        h1 {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .table .btn-sm {
            margin: 0 5px;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 12px;
            }
            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payroll Records</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Role</th>
                    <th>Account Number</th>
                    <th>Bank Name</th>
                    <th>IFSC</th>
                    <th>Payment Mode</th>
                    <th>Payment Account</th>
                    <th>Basic</th>
                    <th>AGP</th>
                    <th>Fixed DA</th>
                    <th>HRA</th>
                    <th>Special Pay</th>
                    <th>HP Allowance</th>
                    <th>Joining Date</th>
                    <th>Gross</th>
                    <th>Grand Total</th>
                    <th>PF Employee Contribution (12%)</th>
                    <th>PF Employer Contribution (13%)</th>
                    <th>Professional Tax</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $payroll)
                    <tr>
                        <td>{{ $payroll->id }}</td>
                        <td>{{ $payroll->employee_name }}</td>
                        <td>{{ $payroll->role }}</td>
                        <td>{{ $payroll->account_number }}</td>
                        <td>{{ $payroll->bank_name }}</td>
                        <td>{{ $payroll->ifsc }}</td>
                        <td>{{ $payroll->payment_mode }}</td>
                        <td>{{ $payroll->payment_account }}</td>
                        <td>{{ $payroll->basic }}</td>
                        <td>{{ $payroll->agp }}</td>
                        <td>{{ $payroll->fixed_da }}</td>
                        <td>{{ $payroll->hra }}</td>
                        <td>{{ $payroll->special_pay }}</td>
                        <td>{{ $payroll->hp_allowance }}</td>
                        <td>{{ $payroll->joining_date }}</td>
                        <td>{{ $payroll->gross }}</td>
                        <td>{{ $payroll->grand_total }}</td>
                        <td>{{ $payroll->pf_employee_contrbn_12 }}</td>
                        <td>{{ $payroll->pf_employer_contrbn_13 }}</td>
                        <td>{{ $payroll->pt }}</td>
                        <td>
                            <a href="{{ route('payroll.edit', $payroll->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
