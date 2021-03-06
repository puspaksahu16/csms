<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreAdmission extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }
    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    public function parents()
    {
        return $this->belongsTo(StudentParent::class,'student_id');
    }
    public function year()
    {
        return $this->belongsTo(PreExam::class,'pre_exam_id');
    }
    public static function laratablesCustomAction($pre_admission)
    {
        return view('admin.pre_admissions.action', compact('pre_admission'))->render();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
