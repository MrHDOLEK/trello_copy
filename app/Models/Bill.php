<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'brutto','currency','netto','vat'
    ];

    protected $hidden = [
        'buyer','items','order_id'
    ];

    public function order() {
        return $this->hasOne(Order::class);
    }
}
