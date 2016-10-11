<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\UserProfile;

class AccountController extends Controller
{
    /**
     *  Display User Profile
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        return view('pages.account.profile')->with('title', 'My Profile');
    }

    /**
     *  Submit Edit Profile
     *  
     *  @return \Illuminate\Http\RedirectReponse
     */    
    public function doProfile(RegisterRequest $request, UserProfile $profile)
    {
        if ($profile->saveProfile(false, auth()->user()->profile, $request)) {
            return redirect()->route('account::profile')
                         ->with('success', trans('message.successProfile')); 
        }            
        
        return redirect()->route('account::profile', $id)
                         ->with('warning', trans('message.failedProfile'));
    }
    
    /**
     *  Display Change Password
     *  
     *  @return \Illuminate\Http\Response
     */    
    public function showChangePassword()
    {
        return view('pages.account.change_password')->with('title', 'Change My Password');
    }

    /**
     *  Submit Change Password
     *  
     *  @return \Illuminate\Http\RedirectReponse
     */        
    public function doChangePassword()
    {
        return redirect()->route('account::change-password')
                         ->with('success', trans('message.successChangePassword'));
    }
}
