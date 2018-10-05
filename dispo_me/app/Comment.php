<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // On dit ici que le modéle Comment dépend du PostModel
    // Et dans le PostModel on dira qu'un post peut avoir plusieur comments(hasMany method)
    public function post(){
        return $this->belongsTo('App\PostModel');
    }
}

