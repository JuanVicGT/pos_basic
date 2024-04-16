<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** 
 * @property int id
 * @property string name
 * @property string email
 * @property string phone
 * @property string address
 * @property string experience
 * @property string image
 * @property string salary
 * @property string vacation
 * @property string city
 */
class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function advance()
    {
        return $this->belongsTo(AdvanceSalary::class, 'id', 'employee_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaySalary::class, 'id', 'employee_id');
    }

    public function advanceByMonth(?string $month = null, ?string $year = null): HasMany
    {
        return $this->hasMany(AdvanceSalary::class, 'employee_id', 'id')
            ->when(
                $month,
                fn ($query) => $query->where('month', $month)
            )
            ->when(
                $year,
                fn ($query) => $query->where('year', $year)
            );
    }

    public function payByMonth(?string $month = null, ?string $year = null): HasMany
    {
        return $this->hasMany(PaySalary::class, 'employee_id', 'id')
            ->when(
                $month || $this->month,
                fn ($query) => $query->where('month', $month)
            )
            ->when(
                $year,
                fn ($query) => $query->where('year', $year)
            );
    }
}
