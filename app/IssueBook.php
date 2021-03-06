<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueBook extends Model
{
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function parent()
    {
        return $this->belongsTo(StudentParent::class);
    }
    public function book()
    {
        return $this->belongsTo(Library::class,'book_id');
    }
    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }
}
