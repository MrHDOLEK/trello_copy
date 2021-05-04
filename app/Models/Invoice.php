<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'brutto','currency','type','pdf','netto','vat','symbol','buyer','items','order_id'
    ];

    protected $hidden = [

    ];

    public function order() {
        return $this->hasOne(Order::class);
    }
    public function createInvoice(int $order_id)
    {

    }
}
