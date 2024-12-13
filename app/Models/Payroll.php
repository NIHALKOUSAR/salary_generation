<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'p1';
    protected $fillable = [
        'institute_id', 'department_id', 'employee_name', 'role', 'account_number', 'bank_name', 'ifsc', 'payment_mode', 'payment_account',
        'variable_da', 'basic', 'agp', 'fixed_da', 'hra', 'special_pay', 'hp_allowance', 'pf_applicable', 'security_deduction', 
        'joining_date', 'gross', 'grand_total', 'pf_employee_contrbn_12', 'pf_employer_contrbn_13', 'pt','tds','netsalary'
    ];
}
