<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Level;
use App\Models\CategoryLanguage;


class Language extends Model
{
    use HasFactory;

    protected  $table = "languages";

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'language_code',
        'language_name'
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function category_languages()
    {
        return $this->belongsToMany(CategoryLanguage::class);
    }

}
