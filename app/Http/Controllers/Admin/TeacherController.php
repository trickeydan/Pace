<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\User;

class TeacherController extends Controller
{
    public function index(Request $request){
        return view('teacher.tg.index',[
            'user' => Auth::User(),
            'request' => $request,
        ]);
    }

    public function pupil(User $user){
        if(!$user->is_pupil())return redirect(route('teacher.tg'))->withErrors('That user is not a pupil!');
       // if($user->tutorgroup_id != Auth::User()->tutorgroup_id)return redirect(route('teacher.tg'))->withErrors('That pupil isn\'t in your Tutor Group. Please contact the main office.' . $user->tutorgroup_id . '  ' . Auth::User()->tutorgroup_id);

        $points = \Pace\Point::where('user_id',$user->id)->orderBy('date','desc')->paginate(15);

        return view('teacher.pupils.view',[
            'pupil' => $user,
            'points' => $points,
        ]);
    }
}
