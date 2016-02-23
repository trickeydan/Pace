<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Pace\Http\Requests\PinChangeRequest;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pace\User;

class PupilController extends Controller
{
    public function index(Request $request){

        $pupils = User::where('user_level',3)->paginate(30);

        return view('admin.pupils.index',[
            'pupils' => $pupils,
            'request' => $request,
        ]);
    }

   /* public function changepin(User $user){
        if($user->is_admin) throw new NotFoundHttpException;
        return view('admin.pupils.changepin',[
            'pupil' => $user
        ]);
    }

    public function postChangepin(User $user,PinChangeRequest $request){
        if($user->is_admin) throw new NotFoundHttpException;

        $user->pin = $request->pin;
        $user->password = bcrypt($request->pin);
        $user->save();
        return redirect(route('admin.pupils.index'))->with('status','Pin Changed');
    }*/
}
