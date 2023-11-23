<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    public function ViewPendingOrder()
    {
        $orders = PurchaseOrder::where('order_status', 'pending')->get();
        return view('backend.purchase.pending_order', compact('orders'));
    } // End Method

    public function ViewCompleteOrder()
    {
        $orders = PurchaseOrder::where('order_status', 'complete')->get();
        return view('backend.purchase.complete_order', compact('orders'));
    } // End Method

    public function ViewOrderDetails($order_id)
    {
        $order = PurchaseOrder::where('id', $order_id)->first();

        $orderItem = PurchaseOrderDetail::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.purchase.order_details', compact('order', 'orderItem'));
    } // End Method

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

    public function OrderStatusUpdate(Request $request)
    {
        $order_id = $request->id;

        $product = PurchaseOrderDetail::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        }

        PurchaseOrder::findOrFail($order_id)->update(['order_status' => 'complete']);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    } // End Method
}
