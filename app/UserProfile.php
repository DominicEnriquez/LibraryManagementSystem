<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    
    protected $fillable = ['contact_number', 'firstname', 'lastname', 'middlename', 'address', 'gender', 'birthdate'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function saveProfile($user, $profile, $request)
    {        
        foreach ($this->fillable as $key) {
            if ($request->has($key)) {
                $profile->{$key} = $request->{$key};
            }                
        }
        if ($user) {
           return $user->save($profile); 
        }
        return $profile->save();    
    }
}
