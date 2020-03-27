<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraClass extends Model
{
    protected $guarded = [];

    public function classes(){
        return $this->belongsTo(Createclass::class,'class_id');
    }
}
