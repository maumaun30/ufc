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

    public function profileCategoryMenus(){
        return $this->hasMany('App\Category')->latest();
    }

    public function profileCategoryAddons(){
        return $this->hasMany('App\AddonCategory')->latest();
    }

    public function profileMenus(){
        return $this->hasMany('App\Menu')->latest();
    }

    public function profileAddons(){
        return $this->hasMany('App\Addon')->latest();
    }

    public function profileInvs(){
        return $this->hasMany('App\Inventory')->latest();
    }

    public function profileSales(){
        return $this->hasMany('App\Sales')->latest();
    }

    public function profileThemes(){
        return $this->hasMany('App\Theme')->latest();
    }

    public function cartQueue(){
        return $this->hasMany('App\Cart')->latest();
    }
}
