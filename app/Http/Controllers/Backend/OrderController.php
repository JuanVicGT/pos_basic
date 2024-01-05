<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class OrderController extends Controller

{
    public function FinalInvoice(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['total_products'] = (int) $request->total_products;
        $data['sub_total'] = (float) Cart::subtotal(6, '.', '');
        $data['tax'] = (float) Cart::tax(6, '.', '');

        $data['invoice_no'] = $request->invoice_no;
        $data['total'] = (float) Cart::total(6, '.', '');
        $data['pay'] = (float) $request->pay;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach ($contents as $item) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $item->id;
            $pdata['quantity'] = $item->qty;
            $pdata['unitcost'] = $item->price;
            $pdata['total'] = $item->total;

            $product = Product::findOrFail($item->id);

            if (!is_numeric($product->product_store))
                $product->product_store = -1;

            $product->update([
                'product_store' => $product->product_store - (float) $item->qty
            ]);

            Orderdetails::insert($pdata);
        } // end foreach

        $notification = array(
            'message' => 'Order Complete Successfully',
            'alert-type' => 'success'
        );

        Cart::destroy();

        return redirect()->route('pos')->with($notification);
    } // End Method

    public function ListOrder()
    {
        $orders = Order::latest()->get();
        return view('backend.sale.all_sale', compact('orders'));
    } // End Method

    public function OrderDetails($order_id)
    {

        $order = Order::where('id', $order_id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.sale.order_details', compact('order', 'orderItem'));
    } // End Method

    public function OrderStatusUpdate(Request $request)
    {

        $order_id = $request->id;

        $product = Orderdetails::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        }

        Order::findOrFail($order_id)->update(['order_status' => 'complete']);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    } // End Method

    public function CompleteOrder()
    {

        $orders = Order::where('order_status', 'complete')->get();
        return view('backend.sale.complete_order', compact('orders'));
    } // End Method

    public function StockManage()
    {

        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));
    } // End Method 

}
