<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public function category() {
        return $this->belongsTo('App\CategoryModel');
    }
}
