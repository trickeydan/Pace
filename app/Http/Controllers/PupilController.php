<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PupilController extends Controller
{

    /**
     * Show the pupil dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $points = $user->accountable->points()->orderBy('date','DESC')->paginate(15); // Order the points and get the 15 appropriate for this page.
        return view('app.pupils.index',compact('points'));
    }

    /**
     * Show the pupil's tutorgroup information..
     *
     * @return \Illuminate\Http\Response
     */
    public function tutorgroup(){
        $user  = Auth::User();
        $competitions = $user->accountable->tutorgroup->competitions()->paginate(15);
        return view('app.pupils.tutorgroup',compact('competitions'));
    }

    /**
     * Show the pupil's house information.
     *
     * @return \Illuminate\Http\Response
     */
    public function house(){
        return view('app.pupils.house');
    }
}
