<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Pace\EventPoint;
use Pace\House;
use Pace\Http\Requests;
use Pace\Log;
use Pace\Series;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\InitialEventCreateRequest;
use Pace\User;
use Pace\Tutorgroup;
use Pace\Event;
use Pace\UserType;

class EventController extends Controller
{
    public function initial(Series $series){
        if($series->events()->count() > 0){
            $prediction = $series->events()->first()->eventpoints()->count();
        }else{
            $prediction = 0;
        }
        return view('series.events.initial',compact('series','prediction'));
    }

    public function create(Series $series, InitialEventCreateRequest $request){

        $participants = array();
        $predictions = array();

       if($series->awardedTo == 'user'){

           if($request->amount > UserType::pupil()->users()->count()){
               return redirect(route('event.initial',$series->id))->withErrors('Participant count exceeds available participants');
           }

           foreach(UserType::pupil()->users()->orderBy('email')->get() as $pupil){
               $participants[$pupil->id] = $pupil->tutorgroup->year->name . ' ' . $pupil->name;
           }

       }
       elseif($series->awardedTo == 'tutorgroup'){

           if($request->amount > Tutorgroup::all()->count()){
               return redirect(route('event.initial',$series->id))->withErrors('Participant count exceeds available participants');
           }

           foreach(Tutorgroup::all()->groupBy('year_id') as $year){
               foreach($year as $tg){
                   $participants[$tg->id] = $tg->name;
                   asort($participants);
               }
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
        if($series->events()->count() > 0){
            if($series->events()->first()->eventpoints()->count() == $request->amount){
                foreach($series->events()->first()->eventpoints as $ep){
                    $predictions[count($predictions)] = $ep->participable->id;
                }
            }
        }



        $request->session()->flash('amount',$request->amount);
        $request->session()->flash('name',$request->name);
        return view('series.events.create',[
            'amount' => $request->amount,
            'name' => $request->name,
            'series' => $series,
            'participants' =>$participants,
            'predictions' => $predictions,
        ]);
    }

    public function store(Series $series, Request $request){
        if($series->binary){
            return $this->binaryStore($series,$request);
        }else{
            return $this->pointStore($series, $request);
        }
    }

    private function binaryStore(Series $series, Request $request){
        $this->binaryValidate($series,$request);
        DB::beginTransaction();
        $event = $series->events()->create(['name' => $request->session()->get('name')]);
        $winnerSet = false;
        $used = array(); //To Stop participant duplication
        for($i = 1; $i <= $request->session()->get('amount');$i++){
            if(!$request->has('participant' . $i)) {
                DB::rollBack();
                return redirect(route('event.initial',$series->id))->withErrors('Validation Error');
            }
            if($series->awardedTo == 'user'){
                $model = User::find($request->get('participant' . $i));
                if(!$model->is_pupil()){
                    DB::rollBack();
                    return redirect(route('event.initial',$series->id))->withErrors('Non-Pupils cannot have points assigned.');
                }
            }
            elseif($series->awardedTo == 'tutorgroup'){
                $model = Tutorgroup::find($request->get('participant' . $i));
            }
            elseif($series->awardedTo == 'house'){
                $model = House::find($request->get('participant' . $i));
            }
            if($model == null){
                DB::rollBack();
                return redirect(route('event.initial',$series->id))->withErrors('Model Error.');
            }

            if(in_array($model->id,$used)){
                return redirect(route('event.initial',$series->id))->withErrors('Duplicate participant: ' . $model->name);
            }

            if($request->has('binary' . $i)){
                $winnerSet = true;
                $ep = new EventPoint();
                $ep->event_id = $event->id; //Manual Association needed because polymorphics
                $ep->amount = 1;
                $ep->participable()->associate($model);
                $ep->save();
            }else{
                $ep = new EventPoint();
                $ep->event_id = $event->id; //Manual Association needed because polymorphics
                $ep->amount = 0;
                $ep->participable()->associate($model);
                $ep->save();
            }
            $model->updatePoints();
            if(isset($model->tutorgroup)){
                $model->tutorgroup->updatePoints();
            }
            if(isset($model->year)){
                $model->year->updatePoints();
            }
            $used[count($used)] = $model->id;
        }
        if($winnerSet){
            DB::commit();
            return redirect(route('series.view',$series->id))->with('status','Event Created');
        }else{
            DB::rollBack();
            return redirect(route('event.initial',$series->id))->withErrors('No winner selected');
        }

    }

    private function binaryValidate(Series $series, Request $request){
        if($series->awardedTo == 'user'){
            $rules =  [
                'participant*' => 'required|exists:users,id,type_id,1',
            ];
        }
        elseif($series->awardedTo == 'tutorgroup'){
            $rules =  [
                'participant*' => 'required|exists:tutorgroups,id',
            ];
        }
        elseif($series->awardedTo == 'house'){
            $rules =  [
                'participant*' => 'required|exists:houses,id',
            ];
        }else{
            throw new \Exception("Unknown Enum Type");
        }

        $this->validate($request,$rules);
    }

    private function pointStore(Series $series, Request $request){
        $this->pointValidate($series,$request);
        DB::beginTransaction();
        $event = $series->events()->create(['name' => $request->session()->get('name')]);

        $used = array(); //To Stop participant duplication
        for($i = 1; $i <= $request->session()->get('amount');$i++){
            if(!$request->has('participant' . $i) || !$request->has('points' . $i)) {
                DB::rollBack();
                return redirect(route('event.initial',$series->id))->withErrors('Validation Error');
            }
            if($series->awardedTo == 'user'){
                $model = User::find($request->get('participant' . $i));
                if(!$model->is_pupil()){
                    DB::rollBack();
                    return redirect(route('event.initial',$series->id))->withErrors('Non-Pupils cannot have points assigned.');
                }
            }
            elseif($series->awardedTo == 'tutorgroup'){
                $model = Tutorgroup::find($request->get('participant' . $i));
            }
            elseif($series->awardedTo == 'house'){
                $model = House::find($request->get('participant' . $i));
            }
            if($model == null){
                DB::rollBack();
                return redirect(route('event.initial',$series->id))->withErrors('Model Error.');
            }

            if(in_array($model->id,$used)){
                return redirect(route('event.initial',$series->id))->withErrors('Duplicate participant: ' . $model->name);
            }

            $ep = new EventPoint();
            $ep->event_id = $event->id; //Manual Association needed because polymorphics
            $ep->amount = $request->get('points' . $i);
            $ep->participable()->associate($model);
            $ep->save();

            $used[count($used)] = $model->id;
        }
        DB::commit();
        Log::log('Created points series');
        return redirect(route('series.view',$series->id))->with('status','Event Created');
    }

    private function pointValidate(Series $series, Request $request){
        if($series->awardedTo == 'user'){
            $rules =  [
                'participant*' => 'required|exists:users,id,type_id,1',
                'points*' => 'required|integer|min:0|max:100000',
            ];
        }
        elseif($series->awardedTo == 'tutorgroup'){
            $rules =  [
                'participant*' => 'required|exists:tutorgroups,id',
                'points*' => 'required|integer|min:0|max:100000',
            ];
        }
        elseif($series->awardedTo == 'house'){
            $rules =  [
                'participant*' => 'required|exists:houses,id',
                'points*' => 'required|integer|min:0|max:100000',
            ];
        }else{
            throw new \Exception("Unknown Enum Type");
        }

        $this->validate($request,$rules);
    }

    public function edit(Series $series, Event $event){
        if($event->series->id != $series->id) return redirect(route('series.view',$series->id))->withErrors('No such event in this series.');
        return view('series.events.edit',compact('event','series'));
    }

    public function update(Series $series, Event $event,Request $request){
        if($series->binary){
            $this->binaryValidate($series,$request);

            DB::beginTransaction();
            $found = false;
            foreach($event->eventpoints as $ep){
                if($request->has('binary' . $ep->participable->id)){
                    if($found) return redirect(route('event.edit',[$series->id,$event->id]))->withErrors('More than one winner selected!');
                    $found = true;
                    $ep->amount = 1;
                }else{
                    $ep->amount = 0;
                }
                $ep->save();
            }
            if($found){
                DB::commit();
                Log::log('Updated Series');
                return redirect(route('series.view',$series->id))->with('status','Event updated.');
            }else{
                DB::rollback();
                return redirect(route('event.edit',[$series->id,$event->id]))->withErrors('No Winner selected!');
            }

        }else{
            $this->pointValidate($series,$request);
            DB::beginTransaction();
            foreach($event->eventpoints as $ep){
                if($request->has('points' . $ep->participable->id)){
                    $ep->amount = $request->get('points' . $ep->participable->id);
                }else{
                    return redirect(route('event.edit',[$series->id,$event->id]))->withErrors('Points Entry missing.');
                }
                $ep->save();
            }
            DB::commit();
            Log::log('Updated Series');
            return redirect(route('series.view',$series->id))->with('status','Event updated.');
        }
    }

    public function delete(Series $series, Event $event){
        $event->delete();
        Log::log('Deleted Series');
        return redirect(route('series.view',$series->id))->with('status','Event deleted.');
    }
}
