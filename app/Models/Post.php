<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Content;
use App\Models\SeoContent;
use App\Models\Level;


class Post extends Model
{
    use HasFactory;

    protected  $table = "posts";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'author',
        'original_content',
        'original_seo_content',
        'original_language_code',
        'published',
        'published_at',
        'categories',
        'level',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $attributes = [
        'author' => 'Amandine Levecq',
        'original_language_code' => 'EN',
        'published' => 1,
        'categories' => '',
        'level' => 1,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    public function seo_contents()
    {
        return $this->belongsToMany(SeoContent::class);
    }

    public function levels()
    {
        return $this->belongsToOne(Level::class);
    }
}
