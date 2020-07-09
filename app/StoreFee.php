<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreFee extends Model
{
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
