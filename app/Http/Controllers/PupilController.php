<?php

namespace App\Http\Controllers;

use App\Models\Competitions\Competition;
use App\Models\Competitions\Event;
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
     * View a competition.
     *
     * @param Competition $competition
     * @return \Illuminate\View\View
     */
    public function competition(Competition $competition){
        $events = $competition->events()->paginate(15);
        return view('app.pupils.competition',compact('competition','events'));
    }

    /**
     * View an event
     *
     * @param Competition $competition
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function event(Competition $competition,Event $event){
        return view('app.pupils.event',compact('competition','event'));
    }

    /**
     * Show the pupil's house information.
     *
     * @return \Illuminate\Http\Response
     */
    public function house(){
        $user  = Auth::User();
        $competitions = $user->accountable->tutorgroup->house->competitions()->paginate(15);
        return view('app.pupils.house',compact('competitions'));
    }
}
