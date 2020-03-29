<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Createclass extends Model
{
    protected $guarded = [];

    public function standard()
    {
        return $this->belongsTo(Standard::class,'standard_id');
    }
}
