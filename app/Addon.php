<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    public function categoryAddon(){
        return $this->belongsTo('App\AddonCategory', 'category_id');
    }
}
