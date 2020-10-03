<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class School extends Model
{
    protected  $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
