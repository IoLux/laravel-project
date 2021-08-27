<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Arr;

class Article extends Model
{
    
    protected $fillable = [
        "title",
        "slug",
        "body",
        "user_id",
        "category_id"
    ];

    protected $with = [
        "category",
        "user"
    ];

    public function scopeFilter($query, array $filters)
    {
        //search
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'));

        //category
          $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category)  {
                $query->where('slug', $category);
            });
        });
            
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
