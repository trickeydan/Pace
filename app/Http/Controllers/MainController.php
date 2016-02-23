<?php

namespace Pace\Http\Controllers;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home() //My PACE Points
    {
        $points = \Pace\Point::where('user_id',Auth::User()->id)->orderBy('date','desc')->paginate(15);
        return view('home',[
            'points' => $points,
        ]);
    }

    public function stats(){
        return view('stats');
    }

    public function feedback(){
        return view('feedback');
    }

    public function feedbackStore(Request $request){
        Auth::User()->feedbacks()->create($request->all());
        return redirect(Auth::User()->homeUrl())->with('status','Feedback Submitted, Thanks.');
    }
}
