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
use App\Models\CashMovement;
use App\Models\ProductMovement;

class PurchaseOrderController extends Controller
{
    public function ListPurchase()
    {
        $orders = PurchaseOrder::latest()->get();
        return view('backend.purchase.all_order', compact('orders'));
    } // End Method

    public function ViewPurchase($order_id)
    {
        $order = PurchaseOrder::where('id', $order_id)->first();
        $items = PurchaseOrderDetail::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.purchase.view_order', compact('order', 'items'));
    } // End Method

    public function FinalInvoice(Request $request)
    {
        $data = array();
        $data['supplier_id'] = $request->supplier_id;
        $data['invoice_no'] = 'PPOS' . mt_rand(10000000, 99999999);
        $data['total_products'] = count(Cart::instance('purchase')->content());
        $data['total'] = (float) Cart::instance('purchase')->total(6, '.', '');

        $data['order_date'] = Carbon::now();
        $data['created_at'] = Carbon::now();

        $order_id = PurchaseOrder::insertGetId($data);
        $items = Cart::content();

        $amount = (float) Cart::instance('purchase')->total(6, '.', '');
        CashMovement::addExpense($amount, 'purchase', $order_id, $data['invoice_no']);

        $pdata = array();
        foreach ($items as $item) {
            $pdata['order_id'] = $order_id;
            $pdata['quantity'] = $item->qty;
            $pdata['product_id'] = $item->id;
            $pdata['unitcost'] = $item->price;

            $pdata['tax'] = $item->pricetax;
            $pdata['unittax'] = $item->tax;

            $pdata['discount'] = $item->discountTotal;

            $pdata['subtotal'] = $item->subtotal;
            $pdata['total'] = $item->total;

            $product = Product::findOrFail($item->id);

            if (!is_numeric($product->product_store))
                $product->product_store = 0;

            $product->update([
                'product_store' => $product->product_store + (float) $item->qty
            ]);

            PurchaseOrderDetail::insert($pdata);

            ProductMovement::addMovement($item->id, (float) ($item->qty), $order_id, __('Purchase Order'), $item->name);
        } // end foreach

        $notification = array(
            'message' => __('Purchase Order Complete Successfully'),
            'alert-type' => 'success'
        );

        Cart::instance('purchase')->destroy();

        return redirect()->route('all.purchase.order')->with($notification);
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
            'message' => ('Purchase Order Done Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    } // End Method
}
