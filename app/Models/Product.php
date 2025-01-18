<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int category_id
 * 
 * @property string product_name
 * @property string barcode
 * @property string product_code
 * @property string product_image
 * @property string product_store
 * 
 * @property float product_garage
 * @property float buying_price
 * @property float selling_price
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
