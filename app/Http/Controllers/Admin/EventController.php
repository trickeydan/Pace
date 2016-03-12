<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Series;
use Pace\Http\Controllers\Controller;

class EventController extends Controller
{
    public function initial(Series $series){

        return view('series.events.initial',compact('series'));
    }
}
