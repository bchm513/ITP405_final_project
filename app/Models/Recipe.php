<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }
    
    public function bookmarkedBy() {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'user_id', 
        'title',
        'description',
        'ingredients',
        'instructions',
        'preparation_time',
        'cooking_time',
        'servings',
        'category_id'
    ];
}
