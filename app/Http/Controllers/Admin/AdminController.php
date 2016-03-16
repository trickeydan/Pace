<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Feedback;
use Pace\ImportManager;

class AdminController extends Controller
{
    public function home(){
        return view('stats');
    }
}
