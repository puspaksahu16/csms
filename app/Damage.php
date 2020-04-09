<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    protected $guarded = ['quantity'];

    public function products(){
    	return $this->belongsTo('App\Product', 'product_id');
    }

    public function colors(){
    	return $this->belongsTo('App\ProductColor', 'color_id');
    }

    public function types(){
    	return $this->belongsTo('App\ProductType', 'type_id');
    }

    public function sizes(){
    	return $this->belongsTo('App\ProductSize', 'size_id');
    }

}
