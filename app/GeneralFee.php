<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralFee extends Model
{
    protected $guarded = [];

    public function classes(){
        return $this->belongsTo(Createclass::class,'class_id');
    }
    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }


}
