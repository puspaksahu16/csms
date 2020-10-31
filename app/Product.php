<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function stock(){
    	return $this->hasMany('App\Stock');
    }

    public function damage(){
        return $this->hasMany(Damage::class, 'product_id');
    }

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
    }

    public static function laratablesCustomAction($products)
    {
        return view('admin.products.action', compact('products'))->render();
    }

}
