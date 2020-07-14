<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Createclass::class,'class_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }

}
