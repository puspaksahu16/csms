<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreExam extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }

    public static function laratablesCustomAction($pre_exam)
    {
        return view('admin.pre_exam.action', compact('pre_exam'))->render();
    }
}
