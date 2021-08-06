<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocomment extends Model
{
    use HasFactory;
    public function uploadedVideo()
    {
        return $this->hasMany(videoUpload::class);
    }
    public function author()
    {
        return $this->hasMany(Author::class);
    }
}
