<?php

namespace App\Http\Controllers\Admin\Competitions;

use App\Http\Requests\Competitions\EventStoreRequest;
use App\Models\Competitions\Competition;
use App\Models\Competitions\Event;
use App\Models\Competitions\EventPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display the form to create a new event for the competition
     *
     * @param Competition $competition
     * @return \Illuminate\View\View
     */
    public function create(Competition $competition){
        return view('app.admin.competitions.events.create',compact('competition'));
    }

    /**
     * Create an event.
     *
     * @param Competition $competition
     * @param EventStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Competition $competition, EventStoreRequest $request){
        $event = $competition->events()->create($request->all());
        foreach ($competition->contestants as $contestant){
            $point = $event->eventPoints()->create([
                'amount' => $request->get('points' . $contestant->id),
                'contestable_type' => $competition->contestable_type,
                'contestable_id' => $contestant->id,
            ]);
        }
        return redirect(route('admin.competitions.events.show',[$competition,$event]));
    }

    /**
     * Show the event information.
     *
     * @param Event $event
     * @return \Illuminate\View\View
     */
    public function show(Competition $competition,Event $event){
        if($event->competition->id != $competition->id) return redirect(route('admin.competitions.events.show',[$event->competition,$event]));
        return view('app.admin.competitions.events.show',compact('event','competition'));
    }

    public function delete(Competition $competition,Event $event){
        if ($event->competition->id != $competition->id) return redirect(route('admin.competitions.events.show', [$event->competition, $event]));
        $event->eventPoints()->delete();
        $event->delete();
        return redirect(route('admin.competitions.show',$competition));
    }
}
