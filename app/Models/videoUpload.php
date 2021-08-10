<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class videoUpload extends Model
{
    use HasFactory;
    public function Videocomment()
    {
        return $this->hasMany("App\Models\Videocomment", "videoupload_id", "id");
    }
    public function author()
    {
        return $this->belongsTo("App\Models\Author", "author_id", "id");
    }

    public function category()
    {
        return $this->belongsTo("App\Models\Videocetagory", "videocetagory_id", "id");
    }
}
