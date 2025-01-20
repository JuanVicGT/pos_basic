<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCustomerOrSupplier()
    {
        if ($this->doc_type == 'sale') {
            $document = Order::where('id', $this->doc_id)->first();
            return $document->customer->name;
        }

        if ($this->doc_type == 'purchase') {
            $document = PurchaseOrder::where('id', $this->doc_id)->first();
            return $document->supplier->name;
        }
    }

    public static function addIncome($amount, $doc_type, $doc_id, $description)
    {
        $lastMovement = CashMovement::orderBy('id', 'desc')->first();

        $balance = 0;
        if (!empty($lastMovement->balance)) {
            $balance = $lastMovement->balance;
        }

        $balance += $amount;

        CashMovement::insert([
            'doc_id' => $doc_id,
            'doc_type' => $doc_type,
            'description' => $description,
            'amount' => $amount,
            'final_amount' => $amount,
            'type' => 'in',
            'balance' => $balance,
            'created_at' => Carbon::now(),
            'month' => Carbon::now()->month,
            'year' => Carbon::now()->year,
            'date' => Carbon::now(),
        ]);
    }

    public static function addExpense($amount, $doc_type, $doc_id, $description)
    {
        $lastMovement = CashMovement::orderBy('id', 'desc')->first();

        $balance = 0;
        if (!empty($lastMovement->balance)) {
            $balance = $lastMovement->balance;
        }

        $balance -= $amount;

        CashMovement::insert([
            'doc_id' => $doc_id,
            'doc_type' => $doc_type,
            'description' => $description,
            'amount' => $amount,
            'final_amount' => $amount * -1,
            'type' => 'out',
            'balance' => $balance,
            'created_at' => Carbon::now(),
            'month' => Carbon::now()->month,
            'year' => Carbon::now()->year,
            'date' => Carbon::now(),
        ]);
    }
}
