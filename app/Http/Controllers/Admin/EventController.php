<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\EventCat;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\EventCreateRequest;

class EventController extends Controller
{
    public function index(){
        $events = EventCat::paginate(30);
        return view('events.index',compact('events'));
    }

    public function create(){
        return view('events.create');
    }

    public function store(EventCreateRequest $request){
        $cat = EventCat::create($request->all());
        return redirect(route('events.view',$cat->id));
    }

    public function view(EventCat $event){
        return view('events.view',compact('event'));
    }
}
