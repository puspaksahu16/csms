<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function standard()
    {
        return $this->belongsTo(SetStandard::class);
    }
}

