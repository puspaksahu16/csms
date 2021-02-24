<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function history()
    {
        return $this->hasMany(MonthlyFeeHistory::class);
    }
}
