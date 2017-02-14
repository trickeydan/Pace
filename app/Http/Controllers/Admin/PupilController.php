<?php

namespace App\Http\Controllers\Admin;

use App\Pupil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PupilController extends Controller
{
    /**
     * Show the index listing for the pupils.
     *
     * Only show search if there is a search query.
     *
     * @return View
     */
    public function index(Request $request){
        $search_query = $request->input('search_query','');

        $builder = Pupil::where('surname','LIKE','%' . $search_query . '%');

        $builder->orWhere('forename','LIKE','%' . $search_query . '%');
        $builder->orWhere('adno','LIKE',$search_query);

        $pupils = $builder->orderBy('surname')->orderBy('forename')->paginate(20);
        return view('app.admin.pupils.index',compact('pupils'));
    }
}
