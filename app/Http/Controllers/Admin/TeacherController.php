<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;

class TeacherController extends Controller
{
    /**
     * Show the index listing for the teachers.
     *
     * Only show search if there is a search query.
     *
     * @return View
     */
    public function index(Request $request){
        $search_query = $request->input('search_query','');

        $builder = Teacher::where('name','LIKE','%' . $search_query . '%');

        $builder->orWhere('initials','LIKE','%' . $search_query . '%');

        $teachers = $builder->orderBy('name')->paginate(20);
        return view('app.admin.teachers.index',compact('teachers'));
    }

    /**
     * Show the individual listing for the teacher.
     *
     * @return View
     */
    public function view(Teacher $teacher){

        return view('app.admin.teachers.view',compact('teacher'));
    }

    //Todo: Add link/unlink tutorgroup/user account
}
