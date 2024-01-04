<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int customer_id
 * @property string order_date
 * @property string invoice_no
 * @property float tax
 * @property float pay
 * @property float total
 * @property float sub_total
 * @property float total_products
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany(PurchaseOrderDetail::class);
    }
}
