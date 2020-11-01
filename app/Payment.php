<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function address()
    {
        return $this->belongsTo(Address::class, 'student_id','user_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','id');
    }

}
