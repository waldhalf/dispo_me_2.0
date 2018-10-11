<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\SkillTagModel;

class UserProfileModel extends Model
{
    // Du fait qu'on ne suit pas la convention de nomage de la table
    // on dit ici à Laravel quel est le nom de la table que l'on va
    // utiliser
    protected $table = 'user_profile';

    // On définit ici la relation entre la table 'user_profile' et la table
    // users
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    // Le profile aura plusieurs skill_tags. On créé donc une relation à partir d'ici
    // Premier paramètre : le modèle que l'on souhaite couplé avec le modéle actuel
    // Second paramètre : le nom de la table référentielle
    // Troisième parémètre : le nom de la colonne dans la table référentielle sur laquelle on 
    // attache l'id du profil
    // Quatrième paramètre : nom de la colonne dans la table référentielle sur laquelle on attache
    // l'id du tag
    // Cela implique qu'un même profile_id pourra avoir plusieurs skill_tag_id
    public function tags() {
        return $this->belongsToMany('App\SkillTagModel', 'user_skill_tags', 'profile_id', 'skill_tag_id');
    }

    public function follower() {
        return $this->belongsToMany('App\UserProfileModel', 'user_profile', 'user_id', 'follower_id');
    }

    public function followed() {
        return $this->belongsToMany('App\UserProfileModel', 'user_profile', 'user_id', 'followed_id');
    }

}
