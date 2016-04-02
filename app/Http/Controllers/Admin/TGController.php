<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Pace\Http\Controllers\Controller;
use Pace\Http\Requests;
use Pace\Tutorgroup;

class TGController extends Controller
{
    public function view(Tutorgroup $tg){
        dd($tg);
    }
}
