<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
