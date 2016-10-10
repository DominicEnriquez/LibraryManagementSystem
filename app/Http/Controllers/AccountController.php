<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
    public function doProfile()
    {
        return redirect()->route('account::profile')
                         ->with('success', trans('message.successProfile'));
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
