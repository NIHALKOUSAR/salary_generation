<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SalarygenrationController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Route to display employee payroll form
Route::get('details', [PayController::class, 'showDetails'])->name('details');
Route::get('/departments/{collegeId}', [PayController::class, 'getDepartments']);
Route::post('/payroll/store', [PayController::class, 'store'])->name('payroll.store');

Route::get('view', [PayController::class, 'view'])->name('view');
Route::get('/payroll', [PayController::class, 'index'])->name('payroll.index');
Route::post('/payroll/filter', [PayController::class, 'filter'])->name('payroll.filter');
Route::get('/payroll/{id}/edit', [PayController::class, 'edit'])->name('payroll.edit');
Route::put('/payroll/{id}', [PayController::class, 'update'])->name('payroll.update');
Route::delete('/payroll/{id}', [PayController::class, 'destroy'])->name('payroll.destroy');


//salary genration
Route::get('salary', [SalarygenrationController::class, 'showDetails'])->name('salary');
Route::post('/employee/form', [SalarygenrationController::class, 'submitForm'])->name('submit.employee.form');
Route::get('/employee/details', [SalarygenrationController::class, 'showEmployeeDetails'])->name('employee.details');
Route::get('/departments/{collegeId}', [SalarygenrationController::class, 'getDepartments'])->name('get.departments');
Route::post('/generate-salary', [SalarygenrationController::class, 'generateSalary'])->name('generate.salary');
 



Route::get('salary1', [SalarygenrationController::class, 'index'])->name('salary.index');
Route::get('salary/{employeeId}/edit', [SalarygenrationController::class, 'edit'])->name('salary.edit');
Route::put('salary/{employeeId}', [SalarygenrationController::class, 'update'])->name('salary.update');
Route::delete('salary/{id}', [SalarygenrationController::class, 'destroy'])->name('salary.destroy');
