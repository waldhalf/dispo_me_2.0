<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public function category() {
        return $this->belongsTo('App\CategoryModel');
    }
    // Initialisation d'une relation One -> to Many
    // Un post peut avoir plusieur comments
    public function comments() {
        return $this->hasMany('App\Comment', 'post_id');
    }
}
