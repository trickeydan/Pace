<?php

namespace App\Http\Controllers\Admin\Competitions;

use App\Http\Requests\Competitions\CompetitionStoreRequest;
use App\Http\Requests\Competitions\CompetitionUpdateRequest;
use App\Http\Requests\Competitions\CreateFormTwoRequest;
use App\Models\Competitions\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompetitionController extends Controller
{
    /**
     * Get a listing of all the competitions.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $competitions = Competition::orderBy('title')->paginate(20);
        return view('app.admin.competitions.index',compact('competitions'));
    }

    /**
     * Get the form to create a new competition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $types = Competition::getValidContestants();
        return view('app.admin.competitions.create',compact('types'));
    }

    public function createTwo(CreateFormTwoRequest $request){
        $list = call_user_func([$request->contestable_type,'getContestantList']); //We can do this because it is already validated.
        return view('app.admin.competitions.createTwo',compact('request','list'));
    }

    /**
     * Store the information in the request as a new competition.
     *
     * @param CompetitionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompetitionStoreRequest $request){
        $contestantArray = []; //Store valid contestants in here

        //Validation of Contestant data.
        for($i = 1; $i <= $request->contestant_amount;$i++){
            if(!$request->has('contestant' . $i)){
                return redirect(route('admin.competitions.create'))->withErrors('Please submit data for all contestants.');
            }

            $contestantQuery = call_user_func([$request->contestable_type,'find'],$request->get('contestant' . $i));
            if(is_null($contestantQuery)){ //If it doesn't exist.
                return redirect(route('admin.competitions.create'))->withErrors('Unable to find all contestants. Please try again.');
            }
            if(in_array($contestantQuery,$contestantArray)){
                return redirect(route('admin.competitions.create'))->withErrors('You cannot have duplicated contestants.');
            }
            $contestantArray[count($contestantArray)] = $contestantQuery;
        }
        $competition = Competition::create($request->all());

        foreach($contestantArray as $contestant){
            $competition->contestants()->attach($contestant);
        }
        return redirect(route('admin.competitions.show',$competition->id));
    }

    /**
     * Show the information about the competition.
     *
     * @param Competition $competition
     * @return \Illuminate\View\View
     */
    public function show(Competition $competition){
        $events = $competition->events()->paginate(10);
        return view('app.admin.competitions.show',compact('competition','events'));
    }

    /**
     * Display the form to edit this competition.
     *
     * @param Competition $competition
     * @return \Illuminate\View\View
     */
    public function edit(Competition $competition){
        return view('app.admin.competitions.edit',compact('competition'));
    }

    /**
     * Update the title of the competition.
     *
     * @param CompetitionUpdateRequest $request
     * @param Competition $competition
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CompetitionUpdateRequest $request,Competition $competition){
        $competition->title = $request->title;
        if(!$competition->save()) return back()->withErrors('Couldn\'t update competition');
        return redirect(route('admin.competitions.show',$competition))->with('success','Updated.');
    }


    /**
     * Delete the competition
     *
     * @param Competition $competition
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function delete(Competition $competition){
        if(!$competition->delete()) return back()->withErrors('Couldn\'t delete competition');
        return redirect(route('admin.competitions.index'))->with('success','Deleted.');
    }
}
