<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'brutto','currency','type','pdf','netto','vat'
    ];

    protected $hidden = [
        'symbol','buyer','items','order_id'
    ];

    public function order() {
        return $this->hasOne(Order::class);
    }
}
