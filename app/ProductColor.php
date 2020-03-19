<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    public function stock(){
    	return $this->hasMany(Stock::class, 'color_id');
    }
}
