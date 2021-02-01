<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyFeeHistory extends Model
{
    //

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
