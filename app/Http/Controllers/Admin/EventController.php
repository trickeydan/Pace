<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Pace\EventPoint;
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
                if($winnerSet){
                    DB::rollBack();
                    return redirect(route('event.initial',$series->id))->withErrors('More than one winner selected!');
                }else{
                    $winnerSet = true;
                }
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
                'participant*' => 'required|exists:users,id,user_level,1',
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
        return redirect(route('series.view',$series->id))->with('status','Event Created');
    }

    private function pointValidate(Series $series, Request $request){
        if($series->awardedTo == 'user'){
            $rules =  [
                'participant*' => 'required|exists:users,id,user_level,1',
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
}
