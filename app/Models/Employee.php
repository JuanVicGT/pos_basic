<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Created for use from Blade
    public $month;

    public function advance()
    {
        return $this->belongsTo(AdvanceSalary::class, 'id', 'employee_id');
    }

    public function advanceByMonth(?string $month = null): HasMany
    {
        return $this->hasMany(AdvanceSalary::class, 'employee_id', 'id')->where('month', $month ?? $this->month);
    }
}
