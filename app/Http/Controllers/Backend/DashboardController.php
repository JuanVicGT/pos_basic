<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $today = Carbon::today();
        $firstDayCurrentMonth = Carbon::today()->startOfMonth();
        $lastDayCurrentMonth = $firstDayCurrentMonth->copy()->endOfMonth();

        // ==== Purchas orders
        $purchasesTotal = PurchaseOrder::select(
            DB::raw('SUM(total) as total'),
        )
            ->where('order_date', '>=', $firstDayCurrentMonth)
            ->where('order_date', '<=', $lastDayCurrentMonth)
            ->first();

        // ==== Sales orders
        $salesTotal = Order::select(
            DB::raw('SUM(total) as total'),
        )
            ->where('order_date', '>=', $firstDayCurrentMonth)
            ->where('order_date', '<=', $lastDayCurrentMonth)
            ->first();

        // ==== Due amount
        $payAmount = Order::select(
            DB::raw('SUM(pay) as pay'),
        )
            ->where('order_date', '>=', $firstDayCurrentMonth)
            ->where('order_date', '<=', $lastDayCurrentMonth)
            ->first();

        $dueTotal = $salesTotal->total - $payAmount->pay ?? 0;

        // ==== New customers
        $countNewCustomers = Customer::where('created_at', '>=', $firstDayCurrentMonth)
            ->where('created_at', '<=', $lastDayCurrentMonth)
            ->count();

        // ==== Products with less stock
        $products = Product::orderBy('product_store', 'asc')
            ->take(25)
            ->get();

        return view('index')
            ->with('currentYear', date('Y', strtotime($today)))
            ->with('currentMonthText', date('F', strtotime($today)))
            ->with('purchasesTotal', number_format($purchasesTotal->total ?? 0))
            ->with('salesTotal', number_format($salesTotal->total ?? 0, 2))
            ->with('dueTotal', number_format($dueTotal))
            ->with('countNewCustomers', $countNewCustomers)
            ->with('products', $products);
    }
}
