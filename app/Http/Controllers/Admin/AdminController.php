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

    public function feedback(){
        return view('admin.feedback',[
            'feedbacks' => Feedback::orderBy('created_at','DESC')->paginate(8)
        ]);
    }

    public function cacheupdate(){
        ImportManager::cache();
        return redirect(route('admin.pupils.index'))->with('status','Cache Updated');
    }
}
