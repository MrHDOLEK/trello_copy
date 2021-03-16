<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }

    public function packet() {
        return $this->hasOne(Packet::class);
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function bill() {
        return $this->belongsTo(Bill::class);
    }
}
