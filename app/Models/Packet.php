<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $table = 'packets';

    protected $fillable = [
        'name','price','description','permission_id'
    ];

    public function order() {
        return $this->belongsToMany(Order::class);
    }

    public function packetPermission() {
        return $this->hasOne(PacketPermission::class, 'id','permission_id');
    }

    public function checkLimit(int $creator_id)
    {
        $order = Order::where('user_id', $creator_id)->latest()->get();
        if ($order->isEmpty()) {
            $packet = Packet::with('packetPermission')->find(1);
            return [
                'max_tables' => $packet->packetPermission->max_tables,
                'max_teams' => $packet->packetPermission->max_teams,
            ];
        } else {
            return 0;
        }
    }
}
