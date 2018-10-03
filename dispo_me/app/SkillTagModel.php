<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserProfileModel;

class SkillTagModel extends Model
{
    protected $table = 'skill_tags';

    public function userProfile() {
        return $this->belongsToMany('App\UserProfileModel');
    }
}
