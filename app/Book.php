<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'borrow_book', 'book_id', 'user_id');
    }
    
    public function borrow()
    {
        return $this->hasMany('App\BorrowBook', 'book_id');
    }
}
