<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRestriction extends Model
{
    protected $table = 'book_restriction';
    
    public function get()
    {
        return $this->first();
    }
    
    public function duration()
    {
        return $this->get()->max_duration;
    }
    
    public function loan()
    {
        return $this->get()->max_loan;
    }
    
    public function jloan()
    {
        return $this->get()->junior_max_loan;
    }
    
    public function charge()
    {
        return $this->get()->charge_expired;
    }
}
