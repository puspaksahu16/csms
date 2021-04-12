<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEmployeeRole extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employee_role()
    {
        return $this->belongsTo(EmployeeRole::class,'employee_role_id');
    }
}
