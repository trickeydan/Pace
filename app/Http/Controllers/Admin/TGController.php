<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests;
use Pace\Tutorgroup;

class TGController extends Controller
{
    public function view(Tutorgroup $tg,Request $request){
        if($tg->name == null) abort(404);
        return view('admin.tgview',[
            'tg' => $tg,
            'request' => $request,
        ]);
    }
}
