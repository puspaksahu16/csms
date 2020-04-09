<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }
    public static function laratablesCustomAction($student)
    {
        return view('admin.new_admission.action', compact('student'))->render();
    }
}
