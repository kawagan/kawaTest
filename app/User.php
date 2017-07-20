<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts(){
        return $this->hasMany('App\Post','author_id');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function gavatar()
    {
        $email = $this->email;
        $default = "https://cdn1.iconfinder.com/data/icons/business-charts/512/customer-512.png";
        $size = 40;
        return $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }
}
