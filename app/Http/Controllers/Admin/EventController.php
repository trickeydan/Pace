<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(){
        return view('stats');
    }
}
