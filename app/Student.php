<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }
    public function idproof()
    {
        return $this->belongsTo(idproof::class, 'id_proof');
    }
    public function fee()
    {
        return $this->hasOne(AdmissionFee::class, 'student_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    public static function laratablesCustomAction($student)
    {
        return view('admin.new_admission.action', compact('student'))->render();
    }
}
