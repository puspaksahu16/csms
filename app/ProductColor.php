<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductColor;

class ProductColor extends Model
{
    public function stock(){
    	return $this->hasMany('App\ProductColor');
    }
}
