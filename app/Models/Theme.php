<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'themes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name','description','url'
    ];

    protected $hidden = [
        'id','created_at','updated_at'
    ];

    public function table() {
        return $this->belongsTo(Table::class);
    }
}
