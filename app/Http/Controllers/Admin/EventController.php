<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\EventCat;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(){
        $events = EventCat::paginate(30);
        return view('events.index',compact('events'));
    }
}
