<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    use HasFactory;

    protected $table = 'service_settings';

    protected $fillable = [
        'name','table','value','label','readonly'
    ];
}
