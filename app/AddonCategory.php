<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    public function categoryAddons()
	{
		return $this->hasMany('App\Addon', 'category_id');
	}
}
