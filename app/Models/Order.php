<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

    //// Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Orderdetails::class, 'orderdetails', 'order_id', 'id');
    }

    private function printTicketSeparator(Printer &$printer)
    {
        $printer->setTextSize(2, 1);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("====================\n");
    }

    //// Actions
    public function printTicket(?string $printerName): void
    {
        if (empty($printerName))
            return;

        /** @var Customer */
        $customer = $this->customer;

        //// Get Relationships
        $items = Orderdetails::with('product')->where('order_id', $this->id)->orderBy('id', 'DESC')->get();;

        //// Print action
        $conn = new WindowsPrintConnector($printerName);

        $printer = new Printer($conn);

        /// Title
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(2, 1);
        $printer->text(__('proof-of-purchase') . "\n");
        $printer->text($this->invoice_no . "\n");

        /// Header
        $this->printTicketSeparator($printer);
        $printer->setTextSize(1, 1);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text(__('customer') . ": " . $customer->name . "\n");
        $printer->text(__('date') . ": " . $this->order_date . "\n");

        /// Items header
        $this->printTicketSeparator($printer);
        $printer->setTextSize(1, 1);
        $printer->setJustification(Printer::JUSTIFY_LEFT);

        $rightCols = 10;
        $leftCols = 38;
        $left = str_pad(__('quantity') . '  ' . __('description'), $leftCols);
        $right = str_pad(__('amount'), $rightCols, ' ', STR_PAD_LEFT);
        $printer->text("{$left}{$right}\n");

        /// Items
        $this->printTicketSeparator($printer);
        $printer->setTextSize(1, 1);
        $printer->setJustification(Printer::JUSTIFY_LEFT);

        /** @var Orderdetails */
        foreach ($items as $item) {
            $rightCols = 10;
            $leftCols = 38;

            $left = str_pad($item->quantity . '   ' . $item->product->product_code . ' - ' . $item->product->product_name, $leftCols);

            $right = str_pad('Q ' . number_format($item->total, 2), $rightCols, ' ', STR_PAD_LEFT);
            $printer->text("{$left}{$right}\n");
        }

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("\n\n");
        $printer->text(__('articles-total-qty') . ": {$this->total_products} \n");

        /// Footer
        $this->printTicketSeparator($printer);
        $printer->setTextSize(1, 1);

        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text(__('total') . ": Q " . number_format($this->total, '2'));

        /// Final
        $printer->feed(5);
        $printer->cut();
        $printer->close();
    }
}
