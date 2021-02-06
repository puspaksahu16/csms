<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignTeacher extends Model
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

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
