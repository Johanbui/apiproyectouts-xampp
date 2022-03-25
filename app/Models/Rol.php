<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';


    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')
        ->where('roles_permissions.enable', '=', 1);
    }


}
