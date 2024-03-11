<?php
namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documentos extends Model
{
    use HasFactory;
    protected $table = 'documentos';

    protected $dates = ['fecha'];

    //protected $appends = ['file'];

    /*
    public function getFileAttribute()
    {
        return $this->belongsTo(File::class,'file_id');
    }
    */
}
