<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string phone
 * @property string address
 * @property string shopname
 * @property string image
 * @property string account_holder
 * @property string account_number
 * @property string bank_name
 * @property string bank_branch
 * @property string city
 * @property string created_at
 * @property string updated_at
 */
class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
}
