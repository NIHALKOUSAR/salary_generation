<?php

namespace App\Http\Controllers;
use App\Models\College; 
use App\Models\Department;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalarygenrationController extends Controller
{
    public function showDetails()
    {
        $colleges = College::all(); 
        return view('salary genaration.salary', compact('colleges'));  
    }
    public function getDepartments($collegeId)
    {
        $departments = Department::where('cid', $collegeId)->get();
        return response()->json($departments);
    }
    //public function submitForm(Request $request)
    //{
        //$validated = $request->validate([
           // 'institute' => 'required|exists:college,id',
           // 'department' => 'required|exists:dept,id',
           // 'role' => 'required|in:Teaching,Non-Teaching',
           // 'select_month' => 'required|date',
        //]);
        //$selectMonth = $request->input('select_month');
   
        //return redirect()->route('employee.details')->with('selectMonth', $selectMonth);
   //}
   public function submitForm(Request $request)
{
    // Validate the form data
    $validated = $request->validate([
        'institute' => 'required|exists:college,id',
        'department' => 'required|exists:dept,id',
        'role' => 'required|in:Teaching,Non-Teaching',
        'select_month' => 'required|date',   
    ]); 
    $instituteId = $request->input('institute');
    $departmentId = $request->input('department');
    $role = $request->input('role');
    $selectMonth = $request->input('select_month');
     
    $employees = payroll::where('institute_id', $instituteId)
        ->where('department_id', $departmentId)
        ->where('role', $role)
        ->get();
 
    return view('salary genaration.employee-details', compact('employees', 'selectMonth'));
}
 
    public function showEmployeeDetails()
    {
        $employees = Payroll::all(); // This could be filtered as needed.
        return view('salary genaration.employee-details', compact('employees'));
    }
 
    public function generateSalary(Request $request)
{
    $selectedEmployeeIds = $request->input('selected_employees');
    $selectMonth = $request->input('month'); // Format: YYYY-MM
 
    if (!$selectedEmployeeIds || count($selectedEmployeeIds) === 0) {
        return redirect()->route('salary')->with('error', 'Please select at least one employee.');
    } 
    $salaryDetails = [];
    $selectedMonthYear = \Carbon\Carbon::parse($selectMonth);
      
    foreach ($selectedEmployeeIds as $employeeId) {
       $employee = Payroll::find($employeeId);

        if (!$employee) {
            continue;
        } 
        $existingSalary = DB::table('salarygenration')
            ->where('employee_id', $employeeId)
            ->whereMonth('month', '=', $selectedMonthYear->month)
            ->whereYear('month', '=', $selectedMonthYear->year)
            ->first();

        if ($existingSalary) {
            continue;
        } 
        $attendanceRecords = DB::table('sal_eattend')
            ->where('eid', $employeeId)
            ->whereMonth('pdate', '=', $selectedMonthYear->month)
            ->whereYear('pdate', '=', $selectedMonthYear->year)
            ->get(); 
        $earlyPunches = 0;
        $latePunches = 0;
        $after10Count = 0;
        $afterfourCount = 0;
        $presentDays = 0;
        $lossOfPayDays = 0;
 
         foreach ($attendanceRecords as $record) {
            if ($record->aft_10) {
                $after10Count++;
            }
            if ($record->early_p) {
                $earlyPunches++;
            }
            if ($record->aft_four) {
                $afterfourCount++;
            }
            if ($record->late_p) {
                $latePunches++;
            }
            if ($record->status == 'Present')  {
                $presentDays++;
            }
            if ($record->status == 'Loss of Pay') {
                $lossOfPayDays++;
            }
        }
            $perDaySalary = $employee->gross/30;
 
            $totalDeduction = 0;
        if ($presentDays > 0) {
            $totalDeduction += ($after10Count + $afterfourCount + $earlyPunches) * 0.5 * $perDaySalary;
   
        if ($latePunches > 3) {
                $totalDeduction += ($latePunches - 3) * 0.25 * $perDaySalary;
            }
        } 
        $lossOfPayDeduction = $lossOfPayDays * $perDaySalary;
        $netSalary = $employee->gross - $totalDeduction - $lossOfPayDeduction;
    DB::table('salarygenration')->insert([
            'employee_id' => $employeeId,
            'employee_name' => $employee->employee_name,
            'gross' => $employee->gross,
            'total_deduction' => $totalDeduction + $lossOfPayDeduction,
            'net_salary' => $netSalary,
            'basic' => $employee->basic,
            'cid' => $employee->institute_id,
            'did' => $employee->department_id,
            'role' => $employee->role,
            'account_number' => $employee->account_number,
            'bank_name' => $employee->bank_name,
            'ifsc' => $employee->ifsc,
            'payment_mode' => $employee->payment_mode,
            'payment_account' => $employee->payment_account,
            'variable_da' => $employee->variable_da,
            'agp' => $employee->agp,
            'fixed_da' => $employee->fixed_da,
            'hra' => $employee->hra,
            'special_pay' => $employee->special_pay,
            'hp_allowance' => $employee->hp_allowance,
            'pf_applicable' => $employee->pf_applicable,
            'security_deduction' => $employee->security_deduction,
            'grand_total' => $employee->grand_total,
            'pf_employee_contrbn_12' => $employee->pf_employee_contrbn_12,
            'pf_employer_contrbn_13' => $employee->pf_employer_contrbn_13,
            'pt' => $employee->pt,
            'tds' => $employee->tds,
            'month' => $selectedMonthYear->format('Y-m-d'),
            'generated_at' => now(),
        ]); 
        $salaryDetails[] = [
            'name' => $employee->employee_name,
            'gross' => $employee->gross,
            'total_deduction' => $totalDeduction + $lossOfPayDeduction,
            'net_salary' => $netSalary,
        ];
    } 
    if (empty($salaryDetails)) {
        return redirect()->route('salary')->with('error', 'Salary already generated for the selected month for all employees.');
    } 
    return redirect()->route('salary')->with('success', 'Salary generated successfully for the selected employees.');
}
 
public function index()
{
   $salaryDetails = DB::table('salarygenration')->get();
   return view('salary genaration.salary_summary', compact('salaryDetails'));
}

public function edit($employeeId)
{ 
    $salary = DB::table('salarygenration')->where('employee_id', $employeeId)->first();
    if (!$salary) {
        return redirect()->route('salary.index')->with('error', 'Salary record not found.');
    } 
    return view('salary genaration.salary_edit', compact('salary'));
}

public function update(Request $request, $employeeId)
{ 
    $request->validate([
        'gross' => 'required|numeric',
        'net_salary' => 'required|numeric',
        'total_deduction' => 'required|numeric',
       ]);
    DB::table('salarygenration')
        ->where('employee_id', $employeeId)
        ->update([
            'gross' => $request->gross,
            'net_salary' => $request->net_salary,
            'total_deduction' => $request->total_deduction,
        ]);
    return redirect()->route('salary.index')->with('success', 'Salary record updated successfully.');
}

public function destroy($id)
{
    DB::table('salarygenration')->where('id', $id)->delete();
    return redirect()->route('salary.index')->with('success', 'Salary record deleted successfully.');
}

}
