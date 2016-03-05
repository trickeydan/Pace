<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Pace\Event;
use Pace\EventCat;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;

use Pace\Http\Requests\SubEventCreateRequest;

class SubEventController extends Controller
{
    public function create(EventCat $event){
        if($event->events()->count() == 0){
            return $this->createfirst($event);
        }else{
            return $this->createnotfirst($event);
        }
    }

    private function createfirst(EventCat $event){
        return view('events.subevent.createfirst',[
            'event' => $event,
            'options' => [
                'tutorgroup' => "Tutorgroups (ie. Tutor Challenge)",
                'pupil' => "Pupils (ie. Class Competitions)",
                'house' => "Houses (ie. Inter-house competition)",
            ]
        ]);
    }

    private function createnotfirst(EventCat $event){
        dd();
    }

    /*public function store(EventCat $event){
        $se = $event->events()->create(array_add($request->all(),'user_id',Auth::User()->id));
        dd($se);
    }*/

    public function storeFirst(EventCat $event, SubEventCreateRequest $request){
        $se = $event->events()->create(array_add($request->all(),'user_id',Auth::User()->id));
        dd($se);
    }
}
