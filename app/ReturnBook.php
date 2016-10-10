<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    protected $table = 'return_book';
    
    protected $fillable = ['borrow_book_id', 'expired_at'];
    
    public function borrowBook()
    {
        return $this->belongsTo('App\BorrowBook', 'borrow_book_id');
    }
}
