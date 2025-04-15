<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function recipes() {
        return $this->hasMany(Recipe::class, 'recipes');
    }
}
