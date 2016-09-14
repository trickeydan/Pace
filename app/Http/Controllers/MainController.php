<?php

namespace Pace\Http\Controllers;

use Illuminate\Http\Request;

use Pace\Event;
use Pace\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Pace\Series;

class MainController extends Controller
{
    public function home(){ //My PACE Points

        $points = \Pace\Point::where('user_id',Auth::User()->id)->orderBy('date','desc')->paginate(15);
        return view('home',[
            'points' => $points,
        ]);
    }

    public function stats(){
        return view('stats');
    }

    public function publicstats(){
        return view('public.stats');
    }

    public function eventstats(){
        $series = Series::paginate(15);
        return view('eventstats',compact('series'));
    }

    public function eventstatsseries(Series $series){
        return view('eventstatsseries',compact('series'));
    }

    public function eventstatsseriesevent(Event $event){
        return view('eventstatsseriesevent',compact('event'));
    }

    public function temp(){
        return view('emails.pupil',[
            'user' => Auth::User()
        ]);
    }



}
