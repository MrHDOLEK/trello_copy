<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'themes';

    protected $fillable = [
        'name','description'
    ];

    protected $hidden = [
        'url'
    ];

    public function table() {
        return $this->belongsTo(Table::class);
    }
}
