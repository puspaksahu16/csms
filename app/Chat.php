<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }
    public function parent()
    {
        return $this->belongsTo(User::class,'parent_id');
    }
}
