<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfileModel extends Model
{
    // Du fait qu'on ne suit pas la convention de nomage de la table
    // on dit ici à Laravel quel est le nom de la table que l'on va
    // utiliser
    protected $table = 'user_profile';

    // On définit ici la relation entre la table 'user_profile' et la table
    // users
    public function user() {
        return $this->hasOne('App\User');
    }

}
