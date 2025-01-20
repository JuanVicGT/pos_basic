<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashMovement;
use App\Models\Order;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function GeneralBalance()
    {
        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();

        $cashMovements = CashMovement::whereBetween('date', [$start_date, $end_date])
            ->orderBy('id', 'asc')->get();

        return view('backend.report.general_balance', compact('cashMovements', 'start_date', 'end_date'));
    }
    
    public function FilterGeneralBalance(Request $request)
    {
        $start_date = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end_date = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $cashMovements = CashMovement::whereBetween('date', [$start_date, $end_date])
            ->orderBy('id', 'asc')->get();

        return view('backend.report.general_balance', compact('cashMovements', 'start_date', 'end_date'));
    }
}
