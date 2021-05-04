<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status'
    ];

    protected $hidden = [
        'user_id','subscription_id','invoice_data','updated_at','created_at','invoice_data','invoice','hash'
    ];

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
    public function create(int $user_id,bool $invoice,int $sub_id )
    {

    }
}
