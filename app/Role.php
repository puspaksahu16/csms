<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employee_role()
    {
        return $this->hasMany(EmployeeRole::class,'role_id');
    }
}
