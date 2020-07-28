<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];

    public function standards()
    {
        return $this->belongsTo(SetStandard::class , 'standard_id');
    }
}
