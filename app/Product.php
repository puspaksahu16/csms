<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function stock(){
    	return $this->hasMany('App\Stock');
    }
    public static function laratablesCustomAction($products)
    {
        return view('admin.products.action', compact('products'))->render();
    }
}
