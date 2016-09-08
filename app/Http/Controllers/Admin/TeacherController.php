<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index(Request $request){
        return view('teacher.tg.index',[
            'user' => Auth::User(),
            'request' => $request,
        ]);
    }
}
