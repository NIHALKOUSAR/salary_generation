<?php

namespace App\Http\Controllers;
use App\Models\College; 
use App\Models\Department;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function showDetails()
    {
        $colleges = College::all(); 
        return view('detail', compact('colleges'));  
    }
    public function getDepartments($collegeId)
    {
        $departments = Department::where('cid', $collegeId)->get();
        return response()->json($departments);
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'institute' => 'required|exists:college,id',
        'department' => 'required|exists:dept,id',
        'employee_name' => 'required|string|max:255',
        'role' => 'required|string',
        'account_number' => 'required|string',
        'bank_name' => 'required|string',
        'ifsc' => 'required|string',
        'payment_mode' => 'required|string',
        'payment_account' => 'required|string',
        'variable_da' => 'nullable|boolean',
        'basic' => 'required|numeric',
        'agp' => 'required|numeric',
        'fixed_da' => 'required|numeric',
        'hra' => 'required|numeric',
        'special_pay' => 'required|numeric',
        'hp_allowance' => 'required|numeric',
        'pf_applicable' => 'nullable|boolean',
        'security_deduction' => 'nullable|boolean',
        'joining_date' => 'required|date',
        'gross' => 'required|numeric',
        'grand_total' => 'required|numeric',
        'pf_employee_contrbn_12' => 'nullable|numeric',
        'pf_employer_contrbn_13' => 'nullable|numeric',
        'pt' => 'nullable|numeric',
        'tds' => 'nullable|numeric',  
        'netsalary' => 'nullable|numeric'

    ]);

    Payroll::create([
        'institute_id' => $request->institute,
        'department_id' => $request->department,
        'employee_name' => $request->employee_name,
        'role' => $request->role,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'ifsc' => $request->ifsc,
        'payment_mode' => $request->payment_mode,
        'payment_account' => $request->payment_account,
        'variable_da' => $request->variable_da ? 1 : 0,
        'basic' => $request->basic,
        'agp' => $request->agp,
        'fixed_da' => $request->fixed_da,
        'hra' => $request->hra,
        'special_pay' => $request->special_pay,
        'hp_allowance' => $request->hp_allowance,
        'pf_applicable' => $request->pf_applicable ? 1 : 0,
        'security_deduction' => $request->security_deduction ? 1 : 0,
        'joining_date' => $request->joining_date,
        'gross' => $request->gross,
        'grand_total' => $request->grand_total,
        'pf_employee_contrbn_12' => $request->pf_employee_contrbn_12,
        'pf_employer_contrbn_13' => $request->pf_employer_contrbn_13,
        'pt' => $request->pt,
        'tds' => $request->tds,
        'netsalary' => $request->netsalary, 
        
        
    ]);

    return redirect()->back()->with('success', 'Payroll data added successfully.');
}
public function index()
    {
        $payrolls = Payroll::all();
        return view('payroll.index', compact('payrolls'));
    }

    public function view()
    {
        $colleges = College::all(); 
        return view('payroll.payrollview', compact('colleges'));  
    }
    public function filter(Request $request)
    {
        $request->validate([
            'institute' => 'required',
            'department' => 'required',
            'role' => 'required',
        ]);

        $payrolls = Payroll::where('institute_id', $request->institute)
            ->where('department_id', $request->department)
            ->where('role', $request->role)
            ->get();

        return view('payroll.index', compact('payrolls'));
    }
 
     
    public function edit($id)
{
    $payroll = Payroll::findOrFail($id);
    $institutes = college::all();   
    $departments = Department::all();  
    return view('payroll.edit', compact('payroll', 'institutes', 'departments'));
}
     public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update($request->all());
        return redirect()->route('view')->with('success', 'Record updated successfully');
    }
     public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        return redirect()->route('payroll.index')->with('success', 'Record deleted successfully');
    }
}
