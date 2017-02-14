<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('app.teachers.index');
    }
}