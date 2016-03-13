<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\House;
use Pace\Http\Requests;
use Pace\Series;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\InitialEventCreateRequest;
use Pace\User;
use Pace\Tutorgroup;

class EventController extends Controller
{
    public function initial(Series $series){
        $prediction = 0;
        return view('series.events.initial',compact('series','prediction'));
    }

    public function create(Series $series, InitialEventCreateRequest $request){

        $participants = array();

       if($series->awardedTo == 'user'){

           if($request->amount > User::where('user_level','1')->count()){
               return redirect(route('event.initial',$series->id))->withErrors('Participant count exceeds available participants');
           }

           foreach(User::where('user_level','1')->get() as $pupil){
               $participants[$pupil->id] = $pupil->name;
           }
       }
       elseif($series->awardedTo == 'tutorgroup'){

           if($request->amount > Tutorgroup::all()->count()){
               return redirect(route('event.initial',$series->id))->withErrors('Participant count exceeds available participants');
           }

           foreach(Tutorgroup::all() as $tg){
               $participants[$tg->id] = $tg->name;
           }
       }
       elseif($series->awardedTo == 'house'){

           if($request->amount > House::all()->count()){
               return redirect(route('event.initial',$series->id))->withErrors('Participant count exceeds available participants');
           }

           foreach(House::all() as $house){
               $participants[$house->id] = $house->name;
           }
       }


        session([
            'amount' => $request->amount,
            'name' => $request->name
        ]);
        return view('series.events.create',[
            'amount' => $request->amount,
            'name' => $request->name,
            'series' => $series,
            'participants' =>$participants,
        ]);
    }
}
