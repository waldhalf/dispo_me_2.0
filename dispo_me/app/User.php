<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserProfileModel;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {        
        return $this->is_admin === self::ADMIN_TYPE;    
    }

    public function profile() {
        return $this->belongsTo('App\UserProfileModel');
    }

}
