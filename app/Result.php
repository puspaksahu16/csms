<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected  $guarded =[];

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsTo(PreAdmission::class, 'roll_no');
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public static function laratablesCustomAction($results)
    {
        return view('admin.result.action', compact('results'))->render();
    }
}
