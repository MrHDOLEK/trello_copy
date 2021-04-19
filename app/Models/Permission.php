<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = [
        'name', 'type',
    ];
    protected $hidden = [
        'id', 'description', 'rule_name', 'data', 'created_at', 'updated_at'
    ];

    public function userPermission()
    {
        return $this->hasOne(Permission::class,'permission_id', 'id');
    }

}
