<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user_employee_role()
    {
        return $this->hasMany(UserEmployeeRole::class, 'employee_role_id');
    }
}
