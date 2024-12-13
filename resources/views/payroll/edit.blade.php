<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payroll Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
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
        <h1>Edit Payroll Record</h1>
         

        <form action="{{ route('payroll.update', $payroll->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="institute_id">Institute</label>
                        <select name="institute_id" class="form-control">
                            @foreach($institutes as $institute)
                                <option value="{{ $institute->id }}" 
                                    {{ $institute->id == $payroll->institute_id ? 'selected' : '' }}>
                                    {{ $institute->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select name="department_id" class="form-control">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" 
                                    {{ $department->id == $payroll->department_id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="employee_name">Employee Name</label>
                        <input type="text" name="employee_name" value="{{ $payroll->employee_name }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="Teaching" {{ $payroll->role == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                            <option value="Non-Teaching" {{ $payroll->role == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" name="account_number" value="{{ $payroll->account_number }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="bank_name">Select Bank</label>
                    <select name="bank_name" class="form-control" required>
                        <option value="" disabled selected>Select a Bank</option>
                        <option value="State Bank of India" {{ $payroll->bank_name == 'State Bank of India' ? 'selected' : '' }}>State Bank of India</option>
                        <option value="HDFC Bank" {{ $payroll->bank_name == 'HDFC Bank' ? 'selected' : '' }}>HDFC Bank</option>
                        <option value="ICICI Bank" {{ $payroll->bank_name == 'ICICI Bank' ? 'selected' : '' }}>ICICI Bank</option>
                        <option value="Axis Bank" {{ $payroll->bank_name == 'Axis Bank' ? 'selected' : '' }}>Axis Bank</option>
                        <option value="IDFC First Bank" {{ $payroll->bank_name == 'IDFC First Bank' ? 'selected' : '' }}>IDFC First Bank</option>
                        <option value="Canara Bank" {{ $payroll->bank_name == 'Canara Bank' ? 'selected' : '' }}>Canara Bank</option>
                        <option value="Bank of India" {{ $payroll->bank_name == 'Bank of India' ? 'selected' : '' }}>Bank of India</option>
                        <option value="Union Bank of India" {{ $payroll->bank_name == 'Union Bank of India' ? 'selected' : '' }}>Union Bank of India</option>
                        <option value="Central Bank of India" {{ $payroll->bank_name == 'Central Bank of India' ? 'selected' : '' }}>Central Bank of India</option>
                        <option value="Indian Bank" {{ $payroll->bank_name == 'Indian Bank' ? 'selected' : '' }}>Indian Bank</option>
                    </select>
                    @error('bank_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ifsc">IFSC Code</label>
                        <input type="text" name="ifsc" value="{{ $payroll->ifsc }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="payment_mode">Mode of Payment</label>
                    <select name="payment_mode" class="form-control" required>
                        <option value="" disabled selected>Select Payment Mode</option>
                        <option value="Cash" {{ $payroll->payment_mode == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Cheque" {{ $payroll->payment_mode == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                        <option value="PhonePay" {{ $payroll->payment_mode == 'PhonePay' ? 'selected' : '' }}>PhonePay</option>
                    </select>
                    @error('payment_mode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_account">Payment Account</label>
                        <input type="text" name="payment_account" value="{{ $payroll->payment_account }}" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="variable_da">Variable DA Applicable</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="variable_da" name="variable_da" value="1" {{ $payroll->variable_da ? 'checked' : '' }} onchange="toggleHRA()">
                        <label class="custom-control-label" for="variable_da"></label>
                    </div>
                    @error('variable_da')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basic">Basic</label>
                        <input type="number" name="basic" value="{{ $payroll->basic }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agp">AGP</label>
                        <input type="number" name="agp" value="{{ $payroll->agp }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fixed_da">Fixed DA</label>
                        <input type="number" name="fixed_da" value="{{ $payroll->fixed_da }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hra">HRA</label>
                        <input type="number" name="hra" value="{{ $payroll->hra }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="special_pay">Special Pay</label>
                        <input type="number" name="special_pay" value="{{ $payroll->special_pay }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hp_allowance">HP Allowance</label>
                        <input type="number" name="hp_allowance" value="{{ $payroll->hp_allowance }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                 
                    <div class="form-group col-md-4">
                        <label for="pf_applicable">PF Applicable</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="pf_applicable" name="pf_applicable" value="1" {{ $payroll->pf_applicable ? 'checked' : '' }}>
                            <label class="custom-control-label" for="pf_applicable"></label>
                        </div>
                        @error('pf_applicable')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
        
                
                    <div class="form-group col-md-4">
                        <label for="security_deduction">Security Deduction</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="security_deduction" name="security_deduction" value="1" {{ $payroll->security_deduction ? 'checked' : '' }}>
                            <label class="custom-control-label" for="security_deduction"></label>
                        </div>
                        @error('security_deduction')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                 
                
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="joining_date">Joining Date</label>
                        <input type="date" name="joining_date" value="{{ $payroll->joining_date }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gross">Gross</label>
                        <input type="number" name="gross" value="{{ $payroll->gross }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="grand_total">Grand Total</label>
                        <input type="number" name="grand_total" value="{{ $payroll->grand_total }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pf_employee_contrbn_12">PF Employee Contribution (12%)</label>
                        <input type="number" name="pf_employee_contrbn_12" value="{{ $payroll->pf_employee_contrbn_12 }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pf_employer_contrbn_13">PF Employer Contribution (13%)</label>
                        <input type="number" name="pf_employer_contrbn_13" value="{{ $payroll->pf_employer_contrbn_13 }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pt">Professional Tax</label>
                        <input type="number" name="pt" value="{{ $payroll->pt }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary">Update Payroll</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
<script>
    // Function to toggle the 'HRA' field
    function toggleHRA() {
        var variableDA = document.getElementById('variable_da');
        var hraField = document.getElementById('hra');

        if (variableDA.checked) {
            hraField.removeAttribute('readonly');  
        } else {
            hraField.setAttribute('readonly', 'true');  
        }
    }

    
    window.onload = toggleHRA;
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<script>
    
    document.getElementById('institute').addEventListener('change', function() {
        var collegeId = this.value;
        if (collegeId) {
            fetch('/departments/' + collegeId)
                .then(response => response.json())
                .then(data => {
                    var departmentSelect = document.getElementById('department');
                    departmentSelect.innerHTML = '<option value="">Select Department</option>';
                    data.forEach(function(department) {
                        var option = document.createElement('option');
                        option.value = department.id;
                        option.textContent = department.name;
                        departmentSelect.appendChild(option);
                    });
                });
        } else {
            document.getElementById('department').innerHTML = '<option value="">Select Department</option>';
        }
    });
</script>
 
 
<script>
    
    function calculateNetSalary() {
        const basic = parseFloat(document.getElementById('basic').value) || 0;
        const agp = parseFloat(document.getElementById('agp').value) || 0;
        const fixedDa = parseFloat(document.getElementById('fixed_da').value) || 0;
        const hra = parseFloat(document.getElementById('hra').value) || 0;
        const specialPay = parseFloat(document.getElementById('special_pay').value) || 0;
        const hpAllowance = parseFloat(document.getElementById('hp_allowance').value) || 0;
        const netSalary = basic + agp + fixedDa + hra + specialPay + hpAllowance;
        document.getElementById('netsalary').value = netSalary.toFixed(2);
    }
 
    document.querySelectorAll('#basic, #agp, #fixed_da, #hra, #special_pay, #hp_allowance').forEach(input => {
        input.addEventListener('input', calculateNetSalary);
    });
</script>
<script>
    function setProfessionalTax() {
        var gross = parseFloat(document.getElementById('gross').value) || 0;
 
        if (gross >= 25000) {
            document.getElementById('pt').value = '200';
        } else {
            document.getElementById('pt').value = '';
        }
    }
 
    document.getElementById('gross').addEventListener('input', setProfessionalTax);
 
    
    setProfessionalTax();
</script>

 

<script>
    // Function to set Professional Tax and PF contributions based on Basic salary and Security Deduction toggle
    function setPFandTax() {
        var basic = parseFloat(document.getElementById('basic').value) || 0;
        var securityDeductionChecked = document.getElementById('pf_applicable').checked;
        var pfEmployeeField = document.getElementById('pf_employee_contrbn_12');
        var pfEmployerField = document.getElementById('pf_employer_contrbn_13');
        var pfEmployeeContainer = document.getElementById('pf_employee_contrbn_12_container');
        var pfEmployerContainer = document.getElementById('pf_employer_contrbn_13_container');

        // If Security Deduction is checked, show PF fields and calculate their values
        if (securityDeductionChecked) {
            pfEmployeeContainer.style.display = 'block'; // Show PF Employee Contribution 12% field
            pfEmployerContainer.style.display = 'block'; // Show PF Employer Contribution 13% field

            // Calculate PF Employee Contribution (12% of Basic + Fixed DA)
            var fixed_da = parseFloat(document.getElementById('fixed_da').value) || 0;
            var sum = basic + fixed_da;
            var pfEmployee = sum * 0.12;
            pfEmployeeField.value = pfEmployee.toFixed(2);

            // Calculate PF Employer Contribution (13% of Basic + Fixed DA)
            var pfEmployer = sum * 0.13;
            pfEmployerField.value = pfEmployer.toFixed(2);
        } else {
            pfEmployeeContainer.style.display = 'none'; // Hide PF Employee Contribution 12% field
            pfEmployerContainer.style.display = 'none'; // Hide PF Employer Contribution 13% field
            pfEmployeeField.value = ''; // Clear PF Employee Contribution value
            pfEmployerField.value = ''; // Clear PF Employer Contribution value
        }
    }

    // Event listeners to trigger the PF function and Professional Tax field based on changes
    document.getElementById('basic').addEventListener('input', setPFandTax);
    document.getElementById('pf_applicable').addEventListener('change', setPFandTax);
    document.getElementById('fixed_da').addEventListener('input', setPFandTax);

    // Initial call to set the correct state on page load
    setPFandTax();
</script>
