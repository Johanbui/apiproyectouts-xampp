<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeasUsuarios extends Model
{
    use HasFactory;
    protected $table = 'ideas_usuarios';
    protected $fillable = ['id_idea', 'id_usuario','tipoUsuario'];

}
