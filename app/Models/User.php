<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function recipes() {
        return $this->hasMany(Recipe::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function bookmarks() {
        return $this->belongsToMany(Recipe::class, 'bookmarks');
    }

}
