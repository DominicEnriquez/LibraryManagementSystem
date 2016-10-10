<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'author', 'isbn', 'quantities', 'shelf_location'];
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'borrow_book', 'book_id', 'user_id');
    }
    
    public function borrow()
    {
        return $this->hasMany('App\BorrowBook', 'book_id');
    }
    
    public function saveBook($book, $request)
    {        
        foreach ($this->fillable as $key) {
            if ($request->has($key)) {
                $book->{$key} = $request->{$key};
            }                
        }          
        if ($book->save()) {
            return $book;
        }
        return false;
    }
}
