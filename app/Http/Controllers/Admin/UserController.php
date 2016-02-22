<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\User;
use Pace\Http\Requests\MakeUserRequest;

class UserController extends Controller
{
    // Admin User Controller

    public function index(){
        $users = User::where('is_admin',true)->paginate(30);
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
            'is_admin' => true,
        ]);
        return redirect(route('admin.users.index'))->with('status','New Admin User Created');
    }

}
