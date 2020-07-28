<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class , 'school_id');
    }
    public function standard()
    {
        return $this->belongsTo(Standard::class , 'standard_id');
    }
    public function class()
    {
        return $this->belongsTo(Createclass::class , 'class_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class , 'section_id');
    }
    public function period()
    {
        return $this->belongsTo(Period::class , 'period_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class , 'subject_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class , 'employee_id');
    }

}
