<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\User;
use App\UserProfile;
use Auth;

class AuthController extends Controller
{
    protected $username     = 'email';
    
    protected $redirectPath = '/';
    
    protected $loginPath    = '/auth/login';
    
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    /**
     *  Display User Login
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        return view('pages.auth.login')
                    ->with('title', 'Login Form');
    }
    
    /**
     *  Display Member Registration
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showRegister()
    {
        return view('pages.auth.register')
                    ->with('title', 'Create Account');
    }
    
    /**
     *  Submit Member Registration
     *  
     *  @param \App\Http\Requests\RegisterRequest $request
     *  @param \App\User $user
     *  @param \App\UserProfile $profile
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doRegister(RegisterRequest $request, User $user, UserProfile $profile)
    {
        $user = $user->saveAccount($user, $request);
        
        if ($profile->saveProfile($user->profile(), $profile, $request)) {
            
            Auth::loginUsingId($user->id);            
            return redirect()->route('home')
                 ->with('success', trans('message.successRegister'));
        }            
        return redirect()->route('auth::register')
                         ->with('warning', trans('message.failedRegister'));        
    }
    
    /**
     *  Display Forgot Password
     *  
     *  @return \Illuminate\Http\Response
     */    
    public function showForgotPassword()
    {
        return view('pages.auth.forgot_password')
                    ->with('title', 'Forgot Password');
    }
    
    /**
     *  Submit Forgot Password
     *  
     *  @param \App\Http\Requests\ForgotPasswordRequest $request
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doForgotPassword(ForgotPasswordRequest $request)
    {
        //
        
        return redirect()->route('auth::forgot-password')
                         ->with('success', trans('message.successForgotPassword'));                
    }
}
