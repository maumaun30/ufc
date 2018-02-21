<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function cartItems(){
        return $this->hasMany('App\Order');
    }

    public function cartAddons(){
        return $this->hasMany('App\Addon');
    }

    public function cartRating(){
    	return $this->hasOne('App\Rating', 'cart_id');
    }
}
