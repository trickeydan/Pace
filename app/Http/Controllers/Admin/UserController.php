<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\User;
use Pace\Http\Requests\MakeUserRequest;
use Pace\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Admin User Controller

    public function index(){
        $users = User::where('user_level','<>',1)->paginate(30);
        $userPerm = ['','','Teacher','Admin'];
        return view('admin.users.index',['users' => $users,'userPerm' => $userPerm]);
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(MakeUserRequest $request){
        $userPerms = ['teacher' => 2,'admin' => 1];
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'user_level' => $userPerms[$request->account],
        ]);
        return redirect(route('admin.users.index'))->with('status','New Admin User Created');
    }

    public function delete(Request $request,User $user){
        if($user->is_pupil()) return redirect(route('admin.users.index'))->withErrors('That User is not an admin.');
        if($user->id == Auth::User()->id) return redirect(route('admin.users.index'))->withErrors('You cannot delete yourself');
        $user->delete();
        return redirect(route('admin.users.index'))->with('status','User Deleted');
    }

    public function changepassword(){
        return view('admin.users.changepassword');
    }

    public function passwordStore(ChangePasswordRequest $request){
        if(!Hash::check($request->old_password,Auth::User()->password))return redirect(route('admin.users.changepassword'))->withErrors('Your Password Was incorrect.');
        Auth::User()->password = bcrypt($request->password);
        Auth::User()->save();
        return redirect(route('admin.users.index'))->with('status','Password Changed');
    }
}
