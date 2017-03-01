<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PasswordChangeRequest;
use App\Notifications\PasswordChanged;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Show the form for changing your password.
     *
     * @return \Illuminate\View\View
     */
    public function change(){
        return view('app.admin.settings.password');
    }

    /**
     * Change the user's password.
     *
     * @param PasswordChangeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePost(PasswordChangeRequest $request){
        $user = Auth::User();
        $user->password = bcrypt($request->password);
        $res = $user->save();
        if(!$res) {
            System::fatal();
            return redirect(route('admin.settings.password'))->withErrors(['An error occurred.']);
        }

        $user->notify(new PasswordChanged());
        return redirect(route('admin.administrators.index'))->with('success','Password Changed.');
    }
}
