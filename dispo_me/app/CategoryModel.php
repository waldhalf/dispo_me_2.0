<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    // Du fait qu'on ne suit pas la conventionde nomage de la table
    // on dit ici à Laravel quel est le nom de la table que l'on va
    // utiliser
    protected $table = 'categories';

    // On définit ici la relation entre la table 'categories' et la table
    // post_models
    public function posts() {
        return $this->hasMany('App\PostModel');
    }

}
