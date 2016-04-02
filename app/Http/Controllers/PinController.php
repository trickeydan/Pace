<?php

namespace Pace\Http\Controllers;

use Illuminate\Http\Request;
use Pace\Http\Requests\PinSendRequest;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;

use Pace\User;

class PinController extends Controller
{
    public function forgotten(){
        return view('auth.forgotten');
    }

    public function send(PinSendRequest $request){
        if(User::whereEmail($request->email)->count() == 0) return redirect(route('forgot'))->withErrors('No Such Email.');
        $u = User::whereEmail($request->email)->first();
        if(!$u->is_pupil()) return redirect(route('forgot'))->withErrors('Staff Accounts cannot be reset through this.');
        $u->sendPin();
        return redirect(route('login'))->with('status','Your pin has been sent to your email');
    }
}
