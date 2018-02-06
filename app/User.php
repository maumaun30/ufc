<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company', 'address', 'logo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profileMenus(){
        return $this->hasMany('App\Menu');
    }

    public function profileAddons(){
        return $this->hasMany('App\Addon');
    }

    public function profileInvs(){
        return $this->hasMany('App\Inventory');
    }

    public function cartQueue(){
        return $this->hasMany('App\Cart');
    }
}
