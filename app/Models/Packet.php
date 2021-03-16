<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    public function order() {
        return $this->belongsToMany(Order::class);
    }

    public function packetPermission() {
        return $this->hasOne(PacketPermission::class);
    }
}
