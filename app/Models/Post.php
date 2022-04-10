<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['title', 'post_fragment', 'body', 'category_id'];

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
