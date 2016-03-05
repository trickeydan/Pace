<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Series;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests\EventCreateRequest;

class EventController extends Controller
{
    public function index(){
        $series = Series::paginate(30);
        return view('series.index',compact('series'));
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesCreateRequest $request){
        $series = Series::create($request->all());
        return redirect(route('series.view',$series->id));
    }

    public function view(Series $event){
        return view('series.view',compact('series'));
    }
}
