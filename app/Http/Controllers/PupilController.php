<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PupilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $points = $user->accountable->points()->orderBy('date','DESC')->paginate(15);
        return view('app.index',compact('points'));
    }

    /**
     * Show the tutorgroup.
     *
     * @return \Illuminate\Http\Response
     */
    public function tutorgroup(){
        return view('app.tutorgroup');
    }

    /**
     * Show the house.
     *
     * @return \Illuminate\Http\Response
     */
    public function house(){
        return view('app.house');
    }
}
