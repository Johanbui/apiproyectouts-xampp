<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaEstado extends Model
{
    use HasFactory;
    protected $table = 'ideas_estados';
    protected $fillable = ['id_idea', 'id_codigo_estado','id_acta', 'comentario'];

}
