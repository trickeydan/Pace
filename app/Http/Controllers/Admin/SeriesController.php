<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Series;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\SeriesCreateRequest;

class SeriesController extends Controller
{
    public function index(){
        $series = Series::orderBy('name')->paginate(30);
        return view('series.index',compact('series'));
    }

    public function create(){

        return view('series.create');
    }

    public function store(SeriesCreateRequest $request){
        $series = Series::create($request->all());
        return redirect(route('series.index'))->with('status','New Event Series created.');
    }

    public function view(Series $series){
        return view('series.view',compact('series'));
    }

    public function delete(Series $series){
        $series->delete();
        return redirect(route('series.index'))->with('status','Series deleted.');
    }
}
