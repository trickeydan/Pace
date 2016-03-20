<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\User;
use Pace\Http\Requests\MakeUserRequest;
use Pace\Http\Requests\DeleteUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Admin User Controller

    public function index(){
        $users = User::where('user_level',3)->paginate(30);
        return view('admin.users.index',compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(MakeUserRequest $request){
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'user_level' => 3,
        ]);
        return redirect(route('admin.users.index'))->with('status','New Admin User Created');
    }

    public function delete(Request $request,User $user){
        if(!$user->is_admin()) return redirect(route('admin.users.index'))->withErrors('That User is not an admin.');
        if($user->id == Auth::User()->id) return redirect(route('admin.users.index'))->withErrors('You cannot delete yourself');
        $user->delete();
        return redirect(route('admin.users.index'))->with('status','User Deleted');
    }

}
