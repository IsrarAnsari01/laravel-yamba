<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocetagory extends Model
{
    use HasFactory;
    public function uploadedVideo()
    {
        return $this->hasMany(videoUpload::class);
    }
    public function author()
    {
        return $this->belongsToMany(Author::class, "author_videocetagories");
    }
}
