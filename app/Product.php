<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function stock(){
    	return $this->hasMany('App\Stock');
    }

}
