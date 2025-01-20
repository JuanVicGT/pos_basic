<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashMovement;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function AddIncome()
    {
        return view('backend.income.add_income');
    } // End Method

    public function StoreIncome(Request $request)
    {
        $request->validate([
            'details' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ]);

        $order_id = Income::insertGetId([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);

        CashMovement::addIncome($request->amount, 'income', $order_id, $request->details);

        $notification = array(
            'message' => __('Income Inserted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

    public function TodayIncome()
    {
        $date = date("d-m-Y");
        $today = Income::where('date', $date)->get();
        return view('backend.income.today_income', compact('today'));
    } // End Method 

    public function EditIncome($id)
    {
        $income = Income::findOrFail($id);
        return view('backend.income.edit_income', compact('income'));
    } // End Method 


    public function UpdateIncome(Request $request)
    {
        $income_id = $request->id;

        Income::findOrFail($income_id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => __('Income Updated Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('today.income')->with($notification);
    } // End Method

    public function MonthIncome()
    {
        $month = Carbon::now()->month;
        $monthincome = Income::where('month', $month)->get();
        return view('backend.income.month_income', compact('monthincome'));
    } // End Method

    public function FilterYearIncome(Request $request)
    {
        $request->validate([
            'year' => ['required', 'integer']
        ]);

        return redirect()->route('year.income', $request->year);
    }

    public function YearIncome(?string $year = null)
    {
        $digitRegex = "/^\\d+$/";
        $currentYear = date("Y");

        if (empty($year))
            $year = $currentYear;

        if (!preg_match($digitRegex, $year)) {
            $notification = array(
                'message' => __('Year :year not valid', ['year' => $year]),
                'alert-type' => 'danger'
            );
            return redirect()->route('year.income')->with($notification);
        }

        $yearincome = Income::where('year', $year)->get();
        return view('backend.income.year_income', compact('yearincome', 'year'));
    } // End Method
}
