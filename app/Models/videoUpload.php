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

}
