<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Pace\Http\Requests\TutorGroupChangeRequest;
use Pace\Http\Requests\PupilUpdateRequest;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Tutorgroup;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pace\User;

class PupilController extends Controller
{
    public function index(Request $request){

        $pupils = User::where('user_level',1)->paginate(30);

        return view('admin.pupils.index',[
            'pupils' => $pupils,
            'request' => $request,
        ]);
    }

    public function search(Request $request){
        $query =  $request->get('query');
        if(User::whereAdno($query)->count() > 0){
            $pupil = User::whereAdno($query)->first();
            return redirect(route('admin.pupils.view',$pupil->email));
        }else{
            return redirect(route('admin.pupils.index'))->withErrors('No Results found. Please check spelling');
        }
    }

    public function view(User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $tgs = array();
        foreach(Tutorgroup::where('year_id',$user->tutorgroup->year->id)->get() as $tg){
            $tgs[$tg->id] = $tg->name;
        }

        return view('admin.pupils.view',[
            'pupil' => $user,
            'tgs' => $tgs
        ]);
    }

    public function updatetg(TutorGroupChangeRequest $request,User $user){
        if(!$user->is_pupil())return redirect(route('admin.pupils.index'))->withErrors('That user is not a pupil!');
        $user->tutorgroup_id = $request->get('newtg');
        $user->save();
        return redirect(route('admin.pupils.index'))->with('status','Tutor Group Changed');
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
