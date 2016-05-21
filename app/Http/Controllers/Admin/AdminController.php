<?php

namespace Pace\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Pace\Http\Requests;
use Pace\Http\Controllers\Controller;
use Pace\Feedback;
use Pace\ImportManager;
use Pace\User;
use Pace\Log;

class AdminController extends Controller
{
    public function home(){
        return view('stats');
    }

    public function usage(){
        $amountunique = DB::select('SELECT count( DISTINCT (`user_id`) ) AS `amount` FROM LOGS ')[0]->amount;
        return view('admin.usage',[
            'amountunique' => $amountunique,
            'percentageunique' => round( ($amountunique *100) / User::whereUserLevel(1)->count(),3),
            'totalhits' => Log::all()->count(),
            'hitstoday' => DB::table('logs')->select(DB::raw('*'))->whereRaw('Date(created_at) = CURDATE()')->count(),
        ]);
    }

    public function info(){
        return view('admin.info');
    }
}
