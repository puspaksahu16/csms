<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected  $guarded = [];

    public function stock()
    {
        return $this->belongsTo(BookStock::class, 'class_id');
    }

    public function classes()
    {
        return $this->belongsTo(Createclass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }
    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    public static function laratablesCustomAction($books)
    {
        return view('admin.books.action', compact('books'))->render();
    }

}
