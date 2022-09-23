<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\CategoryLanguage;


class Category extends Model
{
    use HasFactory;

    protected  $table = "categories";

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }

    public function category_languages()
    {
        return $this->belongsToMany(CategoryLanguage::class);
    }
}
