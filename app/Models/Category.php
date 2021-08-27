<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "title",
        "slug"
    ];

    

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    use HasFactory;
}
