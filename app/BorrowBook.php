<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    protected $table = 'borrow_book';
    
    protected $fillable = ['book_id'];
    
    public function returnBook()
    {
        return $this->hasOne('App\ReturnBook');
    }
    
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function books()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
    
    public function getUser($id)    
    {
        return $this->whereUserId($id)->whereIsReturn('no');
    }
}