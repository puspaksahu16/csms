<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected  $guarded =[];

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsTo(PreAdmission::class, 'roll_no');
    }
}
