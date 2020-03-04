<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookStock extends Model
{
    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function getAvailableStocksAttribute()
    {
        return $this->stock_in - $this->stock_out;
    }
}
