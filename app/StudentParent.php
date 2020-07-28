<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    public function mqualification()
    {
        return $this->belongsTo(Qualification::class, 'mother_qualification');
    }
    public function fqualification()
    {
        return $this->belongsTo(Qualification::class, 'father_qualification');
    }
    public function mIdproof()
    {
        return $this->belongsTo(Idproof::class, 'mother_id_type');
    }
    public function fIdproof()
    {
        return $this->belongsTo(Idproof::class, 'father_id_type');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }
}
