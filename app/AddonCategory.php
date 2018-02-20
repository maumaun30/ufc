<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddonCategory extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
    public function categoryAddons()
	{
		return $this->hasMany('App\Addon', 'category_id');
	}
}
