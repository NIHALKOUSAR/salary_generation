<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee Payroll</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Add New Employee Payroll</h2>
    <form action="{{ route('payroll.store') }} " method="POST">
        @csrf

        <div class="row">
            <div class="form-group col-md-4">
                <label for="institute">Select Institute</label>
                <select id="institute" name="institute" class="form-control" required>
                    <option value="">Select Institute</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}" {{ old('institute') == $college->id ? 'selected' : '' }}>
                            {{ $college->name }}
                        </option>
                    @endforeach
                </select>
                @error('institute')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        
            <div class="form-group col-md-4">
                <label for="department">Select Department</label>
                <select id="department" name="department" class="form-control" required>
                    <option value="">Select Department</option>
                </select>
                @error('department')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
         
        
       
        

            <div class="form-group col-md-4">
                <label for="employee_name">Employee Name</label>
                <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name') }}" required>
                @error('employee_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="role">Select Role</label>
                <select name="role" class="form-control" required>
                    <option value="">Select Role</option>
                    <option value="Teaching" {{ old('role') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                    <option value="Non-Teaching" {{ old('role') == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        
        

            <div class="form-group col-md-4">
                <label for="account_number">Bank Account Number</label>
                <input type="text" name="account_number" class="form-control" value="{{ old('account_number') }}" required>
                @error('account_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="bank_name">Select Bank</label>
                <select name="bank_name" class="form-control" required>
                    <option value="" disabled selected>Select a Bank</option>
                    <option value="State Bank of India">State Bank of India</option>
                    <option value="HDFC Bank">HDFC Bank</option>
                    <option value="ICICI Bank">ICICI Bank</option>
                    
                    <option value="Axis Bank">Axis Bank</option>
                      
                    <option value="IDFC First Bank">IDFC First Bank</option>
                    <option value="Canara Bank">Canara Bank</option>
                    <option value="Bank of India">Bank of India</option>
                    <option value="Union Bank of India">Union Bank of India</option>
                    <option value="Central Bank of India">Central Bank of India</option>
                    <option value="Indian Bank">Indian Bank</option>
                     
                     
                    
                </select>
                @error('bank_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="ifsc">Bank IFSC</label>
                <input type="text" name="ifsc" class="form-control" value="{{ old('ifsc') }}" required>
                @error('ifsc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="payment_mode">Mode of Payment</label>
                <select name="payment_mode" class="form-control" required>
                    <option value="" disabled selected>Select Payment Mode</option>
                    <option value="Cash" {{ old('payment_mode') == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Cheque" {{ old('payment_mode') == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                    <option value="PhonePay" {{ old('payment_mode') == 'PhonePay' ? 'selected' : '' }}>PhonePay</option>
                </select>
                @error('payment_mode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            

            <div class="form-group col-md-4">
                <label for="payment_account">Payment Account</label>
                <input type="text" name="payment_account" class="form-control" value="{{ old('payment_account') }}" required>
                @error('payment_account')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="variable_da">Variable DA Applicable</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="variable_da" name="variable_da" value="1" {{ old('variable_da') ? 'checked' : '' }} onchange="toggleHRA()">
                    <label class="custom-control-label" for="variable_da"></label>
                </div>
                @error('variable_da')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
         

            <div class="form-group col-md-4">
                <label for="basic">Basic</label>
                <input type="text" name="basic" class="form-control" id="basic" value="{{ old('basic') }}" required>
                @error('basic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="agp">AGP</label>
                <input type="text" name="agp" class="form-control" id="agp" value="{{ old('agp') }}" required>
                @error('agp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="fixed_da">Fixed DA</label>
                <input type="text" name="fixed_da" class="form-control" id="fixed_da" value="{{ old('fixed_da') }}" required>
                @error('fixed_da')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="hra">HRA</label>
                <input type="text" name="hra" class="form-control" id="hra" value="{{ old('hra') }}" readonly>
                @error('hra')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="special_pay">Special Pay (Principal, VP, HOD)</label>
                <input type="text" name="special_pay" class="form-control" id="special_pay" value="{{ old('special_pay') }}" required>
                @error('special_pay')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="hp_allowance">HP Allowance</label>
                <input type="text" name="hp_allowance" class="form-control" id="hp_allowance" value="{{ old('hp_allowance') }}" required>
                @error('hp_allowance')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="pf_applicable">PF Applicable</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="pf_applicable" name="pf_applicable" value="1" {{ old('pf_applicable') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="pf_applicable"></label>
                </div>
                @error('pf_applicable')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            

           <div class="form-group col-md-4">
    <label for="security_deduction">Security Deduction</label>
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="security_deduction" name="security_deduction" value="1" {{ old('security_deduction') ? 'checked' : '' }}>
        <label class="custom-control-label" for="security_deduction"></label>
    </div>
    @error('security_deduction')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
            
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="joining_date">Date of Joining</label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
                @error('joining_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="gross">Gross</label>
                <input type="text" name="gross" class="form-control" id='gross'value="{{ old('gross') }}" required>
                @error('gross')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="grand_total">Grand Total</label>
                <input type="text" name="grand_total" class="form-control" value="{{ old('grand_total') }}" required>
                @error('grand_total')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <h2>DEDUCTIONS</h2>
        <div class="row">
            <div class="form-group col-md-4" id="pf_employee_contrbn_12_container" style="display: none;">
                <label for="pf_employee_contrbn_12">PF (Employee Contribution 12%)</label>
                <input type="text" name="pf_employee_contrbn_12" class="form-control" id="pf_employee_contrbn_12" value="{{ old('pf_employee_contrbn_12') }}" required readonly>
                @error('pf_employee_contrbn_12')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            
            <div class="form-group col-md-4" id="pf_employer_contrbn_13_container" style="display: none;">
                <label for="pf_employer_contrbn_13">PF (Employer Contribution 13%)</label>
                <input type="text" name="pf_employer_contrbn_13" class="form-control" id="pf_employer_contrbn_13" value="{{ old('pf_employer_contrbn_13') }}" required readonly>
                @error('pf_employer_contrbn_13')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="pt">Professional Tax</label>
                <input type="text" name="pt" class="form-control" id="pt" value="{{ old('pt') }}" required readonly>
                @error('pt')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group col-md-4">
                <label for="tds">TDS deduction</label>
                <input type="text" name="tds" class="form-control" value="{{ old('pt') }}" required>
                @error('pt')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="pt">Net Salary</label>
                <input type="text" name="netsalary" id="netsalary"class="form-control" value="{{ old('pt') }}" required readonly>
                @error('etsalary')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </form>
</div>
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
            hraField.removeAttribute('readonly'); // Enable the HRA field
        } else {
            hraField.setAttribute('readonly', 'true'); // Disable the HRA field
        }
    }

    // Initial check for the checkbox on page load
    window.onload = toggleHRA;
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<script>
    // AJAX request to fetch departments based on the selected college
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
    // Function to calculate Net Salary
    function calculateNetSalary() {
        const basic = parseFloat(document.getElementById('basic').value) || 0;
        const agp = parseFloat(document.getElementById('agp').value) || 0;
        const fixedDa = parseFloat(document.getElementById('fixed_da').value) || 0;
        const hra = parseFloat(document.getElementById('hra').value) || 0;
        const specialPay = parseFloat(document.getElementById('special_pay').value) || 0;
        const hpAllowance = parseFloat(document.getElementById('hp_allowance').value) || 0;

        // Calculate Net Salary
        const netSalary = basic + agp + fixedDa + hra + specialPay + hpAllowance;

        // Display in the Net Salary field
        document.getElementById('netsalary').value = netSalary.toFixed(2);
    }

    // Attach event listeners to input fields
    document.querySelectorAll('#basic, #agp, #fixed_da, #hra, #special_pay, #hp_allowance').forEach(input => {
        input.addEventListener('input', calculateNetSalary);
    });
</script>
 
<script>
   /* function toggleProfessionalTaxField() {
        var securityDeductionChecked = document.getElementById('security_deduction').checked;
        var ptContainer = document.getElementById('pt_container');

        // Show or hide the Professional Tax field based on Security Deduction toggle
        if (securityDeductionChecked) {
            ptContainer.style.display = 'block'; // Show the Professional Tax field
        } else {
            ptContainer.style.display = 'none'; // Hide the Professional Tax field
            document.getElementById('pt').value = ''; // Clear the Professional Tax field value
        }
    }

    function setProfessionalTax() {
        var gross = parseFloat(document.getElementById('gross').value) || 0;
        
        // Calculate Professional Tax only if Security Deduction is ON
        if (document.getElementById('security_deduction').checked && gross >= 25000) {
            document.getElementById('pt').value = '200';
        } else {
            document.getElementById('pt').value = '';
        }
    }

    // Event listeners
    document.getElementById('security_deduction').addEventListener('change', function() {
        toggleProfessionalTaxField();
        setProfessionalTax(); // Update Professional Tax value when toggled
    });
    document.getElementById('gross').addEventListener('input', setProfessionalTax);

    // Initial call to set the correct state on page load
    toggleProfessionalTaxField();*/
</script>


<script>
    function setProfessionalTax() {
        var gross = parseFloat(document.getElementById('gross').value) || 0;

        // Calculate Professional Tax based on Gross salary
        if (gross >= 25000) {
            document.getElementById('pt').value = '200';
        } else {
            document.getElementById('pt').value = '';
        }
    }

    // Event listener for Gross input field
    document.getElementById('gross').addEventListener('input', setProfessionalTax);

    // Initial call to set the correct state on page load
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
