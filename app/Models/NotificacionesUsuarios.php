<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacionesUsuarios extends Model
{
    use HasFactory;
    protected $table = 'notificaciones_usuarios';
    protected $fillable = ["id_notificacion","id_usuario"];

}
