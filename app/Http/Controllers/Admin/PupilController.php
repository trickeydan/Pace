<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Pace\Http\Requests\TutorGroupChangeRequest;
use Pace\Http\Requests\PupilUpdateRequest;
use Pace\Http\Requests\HouseChangeRequest;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Tutorgroup;
use Pace\User;
use Pace\House;
use Pace\UserType;

class PupilController extends Controller
{
    public function index(Request $request){

        $pupils = UserType::pupil()->users()->orderBy('email','ASC')->paginate(30);

        return view('admin.pupils.index',[
            'pupils' => $pupils,
            'request' => $request,
        ]);
    }

    public function search(Request $request){
        $query =  $request->get('query');
        if(User::whereId($query)->count() > 0){
            $pupil = User::whereId($query)->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }elseif(User::whereEmail($query)->count() > 0){
            $pupil = User::whereEmail($query)->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }elseif(User::whereEmail($query . '@klbschool.org.uk')->count() > 0){
            $pupil = User::whereEmail($query . '@klbschool.org.uk')->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }
        else {
            return redirect(route('admin.pupils.index'))->withErrors('No Results found. Please check spelling')->with('lastquery',$query);
        }
    }

    public function view(User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');

        $points = \Pace\Point::where('user_id',$user->id)->orderBy('date','desc')->paginate(15);

        return view('admin.pupils.view',[
            'pupil' => $user,
            'points' => $points,
        ]);
    }

}
