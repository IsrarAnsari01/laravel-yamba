<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $casts = [
        'videoCat_id' => 'array',
    ];
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function postedVideos()
    {
        return $this->hasMany(videoUpload::class);
    }
    public function watchCetagoryId()
    {
        return $this->belongsToMany(Videocetagory::class, "author_videocetagories");
    }
}
