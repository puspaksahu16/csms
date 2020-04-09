<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\ProductColor;
use App\Damage;

class Stock extends Model
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

    public function getdamageAttribute(){
    	return Damage::where('product_id', $this->product_id)
            ->where('color_id', $this->color_id)
            ->where('type_id', $this->type_id)
            ->where('gender_id', $this->gender_id)
            ->where('size_id', $this->size_id)
            ->get('damage')->first();
    }

    public function getAvailableStocksAttribute(){
    	return $this->stock_in - $this->stock_out - $this->damage['damage'];
    }

}
