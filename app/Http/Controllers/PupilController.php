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
     * Show the tutorgroup.
     *
     * @return \Illuminate\Http\Response
     */
    public function tutorgroup(){
        return view('app.pupils.tutorgroup');
    }

    /**
     * Show the house.
     *
     * @return \Illuminate\Http\Response
     */
    public function house(){
        return view('app.pupils.house');
    }
}
