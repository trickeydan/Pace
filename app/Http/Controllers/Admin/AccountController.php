<?php

namespace App\Http\Controllers\Admin;

use App\Models\Administrator;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Despite the confusing naming scheme, this controller manages administrators.
     * It does not manage Account classes and children!
     *
     * Most actions in here will require the general system password.
     */

    /**
     * Display all the administrators in an index listing.
     *
     * Also has search functionality for system consistency.
     *
     * Todo: Combine code for search on indexes to reduce duplication
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $search_query = $request->input('search_query','');

        $builder = Administrator::where('name','LIKE','%' . $search_query . '%');


        $admins = $builder->orderBy('name')->paginate(20);
        return view('app.admin.administrators.index',compact('admins'));
    }

    /**
     * Delete the administrator user.
     *
     * @param Administrator $administrator
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Administrator $administrator,Request $request){

        $gspres = $this->requireGSP($request,'Delete Adminstrator User');

        if(!is_null($gspres)) return $gspres;

        if($administrator == $request->user()->accountable) return redirect(route('admin.administrators.index'))->withErrors(['You cannot delete your own account!']);
        //Check that there will be at least one admin left.

        //Notify admin of account deletion
        $administrator->user->delete();
        $administrator->delete();
        //Report to log

        return redirect(route('admin.administrators.index'))->with('success','Deleted Administrator.');
    }

    /**
     * Check to see if the request has confirmed the GSP.
     *
     * If so, continue.
     *
     * Otherwise, redirect to the page to get the GSP.
     *
     * Todo: Implement this in middleware
     *
     * @param Request $request
     * @return mixed
     */
    protected function requireGSP(Request $request,$actionname = 'Unspecified'){

        if(!$request->session()->has('general_system_password')){
            session(['location' => [$request->route()->getName(),$request->route()->parameters()]]);
            return redirect(route('admin.gsp'))->with('actionname',$actionname)->with('gsp','yes');
        }

        if(!System::checkGeneralSystemPassword(session('general_system_password'))){
            session(['location' => [$request->route()->getName(),$request->route()->parameters()]]);
            return redirect(route('admin.gsp'))->with('actionname',$actionname)->with('gsp','yes')->withErrors(['Incorrect GSP']);
        }



        return null;
    }

    /**
     * Display a prompt to get the GSP to check for authorisation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkGSPView(){
        //Check that the GSP has been requested.
        if(session('gsp') != 'yes') return back();

        return view('app.admin.gsp');
    }

    /**
     * Check the GSP returned by the form.
     *
     * Authorise for one additional request if correct.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function checkGSPLogic(Request $request){
        //Todo: add validation
        $location = $request->session()->pull('location',['admin.home',[]]);

        //session(['general_system_password' => $request->gsp]); //All following requests

        $request->session()->flash('general_system_password',$request->gsp); //Authorise for one request.
        //Todo: Report that authorisation has been granted.

        return redirect(route($location[0],$location[1]));
    }
}
