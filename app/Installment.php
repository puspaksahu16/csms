<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
