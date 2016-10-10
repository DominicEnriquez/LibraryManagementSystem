<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    protected $primaryKey = 'id';
    
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }
    
    public function books()
    {
        return $this->belongsToMany('App\Book', 'borrow_book', 'user_id', 'book_id');
    }
    
    public function borrow()
    {
        return $this->hasMany('App\BorrowBook');
    }
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    public function saveAccount($user, $request)
    {        
        foreach ($this->fillable as $key) {
            if ($request->has($key)) {
                $user->{$key} = $request->{$key};
            }                
        }          
        if ($user->save()) {
            return $user;
        }        
        return false;
    }
    
}
