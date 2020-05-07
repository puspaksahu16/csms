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
    public function midproof()
    {
        return $this->belongsTo(idproof::class, 'mother_id_type');
    }
    public function fidproof()
    {
        return $this->belongsTo(idproof::class, 'father_id_type');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
