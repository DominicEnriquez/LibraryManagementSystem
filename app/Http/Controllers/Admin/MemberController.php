<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserProfile;
use App\Http\Requests\RegisterRequest;
use Datatables;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     *  Display Member List
     *  
     *  @return \Illuminate\Http\Response     
     */
    public function showList()
    {
        return view('pages.admin.member_list')->with('title', 'Manage Members');
    }
    
    /**
     *  Datatables Member List
     *  
     *  @return json    
     */
    public function getMemberList()
    {
        $user = User::with('profile')->whereIsAdmin('no');
        
        return Datatables::of($user)->addColumn('age', function($user) {
                                        return Carbon::parse($user->profile->birthdate)->age;
                                    })->addColumn('action', function($user) {
                                        return "<a href='".route("admin::member-edit", $user->id)."'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;
                                                <a href='#' onclick='confirmDelete(\"".route("admin::do-member-delete", $user->id)."\")'><i class='fa fa-trash-o'></i></a>";
                                    })->make(true);
    }
    
    /**
     *  Create New Member
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showAdd()
    {
        return view('pages.admin.member_add')->with('title', 'Create New Member');
    }
    
    /**
     *  Create New Member
     *  
     *  @param \App\Http\Requests\RegisterRequest $request
     *  @param \App\User $user
     *  @param \App\UserProfile $profile
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doAdd(RegisterRequest $request, User $user, UserProfile $profile)
    {
        $user = $user->saveAccount($user, $request);
        
        if ($profile->saveProfile($user->profile(), $profile, $request)) {
            return redirect()->route('admin::member-list')
                             ->with('success', trans('message.successMemberAdd'));
        }            
        
        return redirect()->route('admin::member-add')
                         ->with('warning', trans('message.failedMemberAdd'));        
    }    
    
    /**
     *  Edit Member
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showEdit($id)
    {
        $data['profile'] = User::find($id)->profile;
        
        return view('pages.admin.member_edit', $data)->with('title', 'Edit Member');
    }
    
    /**
     *  Submit Edit Member
     *  
     *  @param \App\Http\Requests\RegisterRequest $request
     *  @param \App\UserProfile $profile
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doEdit(RegisterRequest $request, UserProfile $profile, $id)
    {
        if ($profile->saveProfile(false, User::find($id)->profile, $request)) {
            return redirect()->route('admin::member-list')
                         ->with('success', trans('message.successMemberEdit')); 
        }            
        
        return redirect()->route('admin::member-edit', $id)
                         ->with('warning', trans('message.failedMemberEdit'));       
    }

    /**
     *  Submit Delete Member
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */        
    public function doDelete($id, User $user)
    {
        $user->findOrFail($id)->delete();
        
        return redirect()->route('admin::member-list')
                         ->with('success', trans('message.successMemberDelete'));        
    }

    /**
     *  Restore Member
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */        
    public function doRestore($id, User $user)
    {
        $user->withTrashed()->whereId($id)->restore();
        
        return redirect()->route('admin::member-list')
                         ->with('success', trans('message.successMemberRestore'));        
    }
}
