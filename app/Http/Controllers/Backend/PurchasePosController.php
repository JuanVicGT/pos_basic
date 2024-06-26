<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PurchasePosController extends Controller
{
    public function Pos()
    {
        $product = Product::latest()->get();
        $suppliers = Supplier::latest()->get();
        return view('backend.purchase.pos', compact('product', 'suppliers'));
    } // End Method 

    public function AddCart(Request $request)
    {
        // Por motivos de la librería se usa "price" para alojar el costo del producto
        Cart::instance('purchase')->add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->cost,
            'weight' => 20,
            'options' => ['size' => 'large']
        ]);
        $notification = array(
            'message' => __('Product Added Successfully'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method 

    public function AllItem()
    {
        $product_item = Cart::instance('purchase')->content();
        return view('backend.purchase.pos_item', compact('product_item'));
    } // End Method 

    public function CartUpdate(Request $request, $rowId)
    {
        $qty = $request->qty;
        Cart::instance('purchase')->update($rowId, $qty);

        $notification = array(
            'message' => __('Cart Updated Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

    public function CartRemove($rowId)
    {
        Cart::instance('purchase')->remove($rowId);
        $notification = array(
            'message' => __('Cart Remove Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
