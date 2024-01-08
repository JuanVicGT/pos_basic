<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int order_id
 * @property int product_id
 * @property string quantity
 * @property string unitcost
 * @property string total
 * @property string created_at
 * @property string updated_at
 */
class Orderdetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
