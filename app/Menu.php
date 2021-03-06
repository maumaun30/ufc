<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
	protected $dates = ['deleted_at'];

	public function categoryMenu(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
