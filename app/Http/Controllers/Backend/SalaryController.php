<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function AddAdvanceSalary()
    {

        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employee'));
    } // End Method 

    public function AdvanceSalaryStore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'required'
        ]);

        // No se pueden dar adelantos de fechas pasadas
        $currentMonth = date('F');
        $currentYear = date('Y');

        if ((int) $request->year === (int) $currentYear && $this->getNumMonth((string) $request->month) < $this->getNumMonth($currentMonth)) {
            $notification = array(
                'message' => __('date-not-valid'),
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }

        $employee = Employee::find($request->employee_id);
        $advanced = AdvanceSalary::where('year', $request->year)
            ->where('month', $request->month)
            ->where('employee_id', $employee->id)->first();

        // Solo se permite un único adelanto de salario
        if (!empty($advanced->id)) {
            $notification = array(
                'message' => __('advance-already-paid'),
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }

        AdvanceSalary::insert([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => __('saved-successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification);
    } // End Method 

    public function AdvanceSalaryDelete($id)
    {
        $advancedSalary = AdvanceSalary::findOrFail($id);

        // No se pueden dar adelantos de fechas pasadas
        $currentMonth = date('F');
        $currentYear = date('Y');

        if ((int) $currentYear < (int) $advancedSalary->year) {
            $notification = array(
                'message' => __('cannot-delete-past-advanced'),
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }

        if ((int) $advancedSalary->year === (int) $currentYear && $this->getNumMonth((string) $advancedSalary->month) < $this->getNumMonth($currentMonth)) {
            $notification = array(
                'message' => __('cannot-delete-past-advanced'),
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }

        $advancedSalary->delete();

        $notification = array(
            'message' => __('deleted-successfully'),
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    } // End Method 

    public function AllAdvanceSalary()
    {
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salary'));
    } // End Method

    public function EditAdvanceSalary($id)
    {
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_advance_salary', compact('salary', 'employee'));
    } // End Method 

    public function AdvanceSalaryUpdate(Request $request)
    {

        $salary_id = $request->id;

        AdvanceSalary::findOrFail($salary_id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => __('updated-successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification);
    } // End Method

    /////////////////////////////////////////////PAGAR SALARIOS///////////////////////////////////////////////////
    public function PaySalary()
    {
        $employees = Employee::latest()->get();
        return view('backend.salary.pay_salary', compact('employees'));
    } // End Method 

    public function PayNowSalary($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.salary.paid_salary', compact('employee'));
    } // End Method

    public function EmployeSalaryStore(Request $request)
    {
        $employee_id = $request->id;

        PaySalary::insert([
            'employee_id' => $employee_id,
            'salary_month' => $request->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pay.salary')->with($notification);
    } // End Method 

    public function MonthSalary()
    {

        $paidsalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary', compact('paidsalary'));
    } // End Method

    private function getNumMonth(?string $month): int
    {
        switch ($month) {
            case 'January':
                return 1;
            case 'February':
                return 2;
            case 'March':
                return 3;
            case 'April':
                return 4;
            case 'May':
                return 5;
            case 'June':
                return 6;
            case 'July':
                return 7;
            case 'August':
                return 8;
            case 'September':
                return 9;
            case 'October':
                return 10;
            case 'November':
                return 11;
            case 'December':
                return 12;

            default:
                return 0;
        }
    }
}
