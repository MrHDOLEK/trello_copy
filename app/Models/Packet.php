<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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

    public function checkLimit(int $creator_id): int|array
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

    public function createPacket($validated) {
        Packet::create($validated);
    }

    public function getPackets($validated): Collection {
        if(!empty($validated))
            return Packet::findOrFail($validated);

        return Packet::all();
    }

    public function updatePacket($validated) {
        $packet = Packet::findOrFail($validated['packet_id']);
        $packet->update($validated);
    }

    public function deletePacket($validated) {
        $packet = Packet::findOrFail($validated)->first();
        $packet->delete();
    }
}
