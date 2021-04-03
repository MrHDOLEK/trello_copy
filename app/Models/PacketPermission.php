<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacketPermission extends Model
{
    use HasFactory;

    protected $table = 'packets_permissions';

    protected $fillable = [
        'max_cards','max_teams'
    ];

    public function packet() {
        return $this->belongsToMany(Packet::class);
    }
}
