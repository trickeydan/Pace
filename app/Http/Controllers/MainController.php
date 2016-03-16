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

    public function feedback(){
        return view('feedback');
    }

    public function feedbackStore(Request $request){
        Mail::send('emails.feedback', ['user' => $this,'request' => $request], function ($m) {
            $m->from(env('email'), 'KLBS Pace Points (' . Auth::User()->name . ')');

            $m->to(env('feedbackemail'))->subject('Pace Point Feedback');
        });
        return redirect(Auth::User()->homeUrl())->with('status','Feedback Submitted, Thanks.');
    }
}
