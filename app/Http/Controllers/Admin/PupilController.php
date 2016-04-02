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

class PupilController extends Controller
{
    public function index(Request $request){

        $pupils = User::where('user_level',1)->orderBy('email','ASC')->paginate(30);

        return view('admin.pupils.index',[
            'pupils' => $pupils,
            'request' => $request,
        ]);
    }

    public function create(){
        $tgs = array();
        foreach(Tutorgroup::all() as $tg){
            $tgs[$tg->id] = $tg->name;
        }
        $hs = array();
        foreach(House::all() as $h){
            $hs[$h->id] = $h->name;
        }
        return view('admin.pupils.create',[
            'tgs' => $tgs,
            'houses' => $hs,
        ]);
    }

    public function store(Requests\PupilCreateRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id = $request->adno;
        $user->password = bcrypt($request->adno);
        $user->tutorgroup_id = $request->tutorgroup;
        $user->user_level = 1;
        $user->currPoints = 0;
        $user->house_id = $request->house;
        $user->save();
        return redirect(route('admin.pupils.index'))->with('status','Pupil Created.');
    }

    public function search(Request $request){
        $query =  $request->get('query');
        if(User::whereId($query)->count() > 0){
            $pupil = User::whereId($query)->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }elseif(User::whereEmail($query)->count() > 0){
            $pupil = User::whereEmail($query)->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }
        else {
            return redirect(route('admin.pupils.index'))->withErrors('No Results found. Please check spelling')->with('lastquery',$query);
        }
    }

    public function view(User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $tgs = array();
        foreach(Tutorgroup::where('year_id',$user->tutorgroup->year->id)->get() as $tg){
            $tgs[$tg->id] = $tg->name;
        }
        $hs = array();
        foreach(House::all() as $h){
            $hs[$h->id] = $h->name;
        }

        return view('admin.pupils.view',[
            'pupil' => $user,
            'tgs' => $tgs,
            'houses' => $hs,
        ]);
    }

    public function updatetg(TutorGroupChangeRequest $request,User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $user->tutorgroup_id = $request->get('newtg');
        $user->save();
        return redirect(route('admin.pupils.view',$user->email))->with('status','Tutor Group Updated');
    }

    public function updatehouse(HouseChangeRequest $request,User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $user->house_id = $request->get('newhouse');
        $user->save();
        return redirect(route('admin.pupils.view',$user->email))->with('status','House Updated');
    }

    public function edit(User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        return view('admin.pupils.edit',[
            'pupil' => $user
        ]);
    }

    public function update(PupilUpdateRequest $request, User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect(route('admin.pupils.index'))->with('status','Pupil Updated');
    }
}
