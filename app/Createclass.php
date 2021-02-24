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
    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }
    public function section()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    public function class_teacher()
    {
        return $this->hasOne(AssignTeacher::class, 'class_id');
    }
}
