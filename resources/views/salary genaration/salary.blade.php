<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Employee Salary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Ensure the container takes full height of the screen */
        .full-height {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    @if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif

@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif
<div class="container full-height">
    <div class="row w-100">
        <div class="col-md-6 mx-auto">
            <h2 class="text-center mb-4">Get Employee Salary</h2>
            <form action="{{ route('submit.employee.form') }}" method="POST">
                @csrf

                <div class="form-group">
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

                <div class="form-group">
                    <label for="department">Select Department</label>
                    <select id="department" name="department" class="form-control" required>
                        <option value="">Select Department</option>
                    </select>
                    @error('department')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
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

                <div class="form-group">
                    <label for="select_month">Select Month</label>
                    <input type="date" name="select_month" class="form-control" value="{{ old('select_month') }}" required>
                    @error('select_month')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
    $(document).ready(function() {
         
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    });
</script>