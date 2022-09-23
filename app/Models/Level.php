<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected  $table = "levels";

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function model_languages()
    {
        return $this->belongsToMany(ModelLanguage::class);
    }
}
