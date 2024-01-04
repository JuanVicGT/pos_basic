<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function SalePurchaseDifference(Request $request)
    {
        $sales = Order::latest()->get();
        $purchases = PurchaseOrder::latest()->get();

        return view('backend.report.sale_purchase_difference', compact('sales', 'purchases'));
    }
}
