<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }


    public function Idproof()
    {
        return $this->belongsTo(Idproof::class, 'id_proof');
    }
    public function fee()
    {
        return $this->hasOne(AdmissionFee::class, 'student_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

//    public function student_section()
//    {
//        return $this->belongsTo(Section::class, 'section');
//    }

    public function parent()
    {
        return $this->hasOne(StudentParent::class, 'student_id');
    }

    public function section_data()
    {
        return $this->belongsTo(Section::class,'section');
    }

    public static function laratablesCustomAction($student)
    {
        return view('admin.new_admission.action', compact('student'))->render();
    }
}
