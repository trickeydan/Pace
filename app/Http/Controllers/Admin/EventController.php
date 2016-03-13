<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Series;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\InitialEventCreateRequest;

class EventController extends Controller
{
    public function initial(Series $series){
        $prediction = 0;
        return view('series.events.initial',compact('series','prediction'));
    }

    public function create(Series $series, InitialEventCreateRequest $request){

        session([
            'amount' => $request->amount,
            'name' => $request->name
        ]);
        return view('series.events.create',[
            'amount' => $request->amount,
            'name' => $request->name,
            'series' => $series,
        ]);
    }
}
