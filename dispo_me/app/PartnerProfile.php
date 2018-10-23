<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerProfile extends Model
{
    // On rentre le nom de la table ici
    protected $table = 'partners_UserProfile';
    protected $fillable = [
        'urlPartner', 'active'
    ];
}
