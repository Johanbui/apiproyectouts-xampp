<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';

    protected $dates = ['fecha'];

    //protected $appends = ['file'];

    /*
    public function getFileAttribute()
    {
        return $this->belongsTo(File::class,'file_id');
    }
    */
}
