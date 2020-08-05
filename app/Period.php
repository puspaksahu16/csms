<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];

    public function standard()
    {
        return $this->belongsTo(Standard::class , 'standard_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }
}
