<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductMovement;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));
    } // End Method 

    public function AddProduct()
    {
        $category = Category::latest()->get();
        return view('backend.product.add_product', compact('category'));
    } // End Method 

    public function StoreProduct(Request $request)
    {
        $validate = $request->validate([
            'product_name' => 'required|unique:products',
            'barcode' => 'required',
            'category_id' => 'required',
            'product_image' => 'required',
            'product_garage' => 'required|numeric',
            'product_store' => 'required|numeric',
            'buying_price' => 'required',
            'selling_price' => 'required'
        ]);

        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 4, 'prefix' => 'PC']);
        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
        $save_url = 'upload/product/' . $name_gen;

        $stock = $request->product_garage === 0 ? 0.0 : $request->product_garage;

        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'barcode' => $request->barcode,
            'category_id' => $request->category_id,
            'product_code' => $pcode,
            'product_garage' => $stock,
            'product_store' => $request->product_store,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        ProductMovement::addMovement($product_id, (float) ($request->product_store), NULL, __('Creation'), $request->product_name);

        $notification = array(
            'message' => __('Product Inserted Successfully'),
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    } // End Method 

    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        return view('backend.product.edit_product', compact('product', 'category'));
    } // End Method 

    public function UdateProduct(Request $request)
    {
        $product_id = $request->id;
        $last_stock = 0;
        $new_stock = $request->product_store;

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
            $save_url = 'upload/product/' . $name_gen;

            $product = Product::findOrFail($product_id);

            $last_stock = $product->product_store;

            $product->update([
                'product_name' => $request->product_name,
                'barcode' => $request->barcode,
                'category_id' => $request->category_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'product_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => __('Product Updated Successfully'),
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        } else {
            $product = Product::findOrFail($product_id);

            $last_stock = $product->product_store;

            $product->update([
                'product_name' => $request->product_name,
                'barcode' => $request->barcode,
                'category_id' => $request->category_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => __('Product Updated Successfully'),
                'alert-type' => 'success'
            );

            // Stock Movement Add
            if ($new_stock < $last_stock) {
                $quantity = $last_stock - $new_stock;
                ProductMovement::addMovement($product_id, (float) ($quantity * -1), NULL, __('Adjustment'), $request->product_name);
            }

            // Stock Movement Remove
            if ($new_stock > $last_stock) {
                $quantity = $new_stock - $last_stock;
                ProductMovement::addMovement($product_id, (float) ($quantity), NULL, __('Adjustment'), $request->product_name);
            }

            return redirect()->route('all.product')->with($notification);
        } // End else Condition  
    } // End Method 

    public function DeleteProduct($id)
    {
        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => __('Product Deleted Successfully'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function BarcodeProduct(Request $request)
    {
        $product = Product::findOrFail($request->item_id);
        $qty = $request->qty ?? 1;

        return view('backend.product.barcode_product', compact('product', 'qty'));
    } // End Method

    public function MovementProduct($id)
    {
        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();

        $product = Product::findOrFail($id);
        $movements = ProductMovement::where('product_id', $product->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->orderBy('id', 'asc')->get();

        return view('backend.product.movement_product', compact('product', 'start_date', 'end_date', 'movements'));
    } // End Method 

    public function FilterMovementProduct(Request $request)
    {
        $start_date = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end_date = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $id = $request->product_id;

        $product = Product::findOrFail($id);
        $movements = ProductMovement::where('product_id', $product->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->orderBy('id', 'asc')->get();

        return view('backend.product.movement_product', compact('product', 'start_date', 'end_date', 'movements'));
    } // End Method 
}
