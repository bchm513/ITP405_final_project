<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    protected $fillable = [
        'user_id', 
        'recipe_id',
        'content',
        'rating',
    ];
}
