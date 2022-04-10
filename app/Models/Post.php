<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
//    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query
                ->where('title', 'like', '%' . request('search') . '%');
        }
        if ($filters['category'] ?? false) {
            $query
                ->whereExists('name', 'like', '%' . request('search') . '%');
        }
        $query->when($filters['author'] ?? false, fn($query, $author) =>
        $query->whereHas('author', fn($query) =>
        $query->where('username', $author)));
    }

    protected function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected function comment()
    {
        return $this->hasMany(Comment::class);
    }

}
