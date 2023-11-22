<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;

use DB;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

class PurchaseOrderController extends Controller
{
    public function FinalInvoice(Request $request)
    {
        $data = array();
        $data['supplier_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;

        $data['invoice_no'] = 'PPOS' . mt_rand(10000000, 99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['created_at'] = Carbon::now();

        $order_id = PurchaseOrder::insertGetId($data);
        $items = Cart::content();

        $pdata = array();
        foreach ($items as $item) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $item->id;
            $pdata['quantity'] = $item->qty;
            $pdata['unitcost'] = $item->price;
            $pdata['total'] = $item->total;

            PurchaseOrderDetail::insert($pdata);
        } // end foreach

        $notification = array(
            'message' => 'Order Complete Successfully',
            'alert-type' => 'success'
        );

        Cart::destroy();

        return redirect()->route('dashboard')->with($notification);
    } // End Method
}
