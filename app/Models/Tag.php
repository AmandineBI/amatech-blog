<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\TagLanguage;


class Tag extends Model
{
    use HasFactory;

    protected  $table = "tags";

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags');
    }

    public function tag_languages()
    {
        return $this->belongsToMany(TagLanguage::class);
    }
}
