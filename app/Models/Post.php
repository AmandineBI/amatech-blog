<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Content;
use App\Models\SeoContent;
use App\Models\Level;
use Spatie\Tags\HasTags;


class Post extends Model
{
    use HasFactory;
    use HasTags;

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
        'archived',
        'archived_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'archived_at' => 'datetime'
    ];

    protected $attributes = [
        'author' => 'Amatech',
        'original_language_code' => 'EN',
        'published' => 0,
        'categories' => '',
        'level' => 1,
        'archived' => 0
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
