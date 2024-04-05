<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function advance()
    {
        return $this->belongsTo(AdvanceSalary::class, 'id', 'employee_id');
    }

    public function advanceByMonth(?string $month = null, ?string $year = null): HasMany
    {
        return $this->hasMany(AdvanceSalary::class, 'employee_id', 'id')
            ->when(
                $month || $this->month,
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
