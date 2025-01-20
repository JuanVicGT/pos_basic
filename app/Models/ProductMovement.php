<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function addMovement($product_id, $quantity, $doc_id, $doc_type, $detail)
    {
        ProductMovement::create([
            'product_id' => $product_id,
            'quantity' => $quantity,
            'doc_id' => $doc_id,
            'doc_type' => $doc_type,
            'detail' => $detail,
            'date' => Carbon::now(),
        ]);
    }

    public static function recalcStock($product_id)
    {
        $movements = ProductMovement::where('product_id', $product_id)->get();
        $quantity = 0;
        foreach ($movements as $movement) {
            $quantity += $movement->quantity;
        }

        $product = Product::find($product_id);
        $product->product_store = $quantity;
        $product->save();
    }
}
