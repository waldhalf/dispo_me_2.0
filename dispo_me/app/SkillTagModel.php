<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserProfileModel;

class SkillTagModel extends Model
{
    // On rentre le nom de la table ici
    protected $table = 'skill_tags';

    // Le Tag aura plusieurs profil. On créé donc une relation à partir d'ici
    // Premier paramètre : le modèle que l'on souhaite couplé avec le modéle actuel
    // Second paramètre : le nom de la table référentielle
    // Troisième parémètre : le nom de la colonne dans la table référentielle sur laquelle on 
    // attache l'id du tag
    // Quatrième paramètre : nom de la colonne dans la table référentielle sur laquelle on attache
    // l'id du profil
    // Cela implique qu'un même profile_id pourra avoir plusieurs skill_tag_id
    public function userProfile() {
        return $this->belongsTo('App\UserProfileModel', 'user_skill_tags', 'skill_tag_id', 'profile_id');
    }
}
