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
}
