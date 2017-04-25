<?php

namespace App\Http\Controllers;

use App\Models\Competitions\Competition;
use App\Models\Competitions\Event;
use App\Models\Pupil;
use App\Models\Tutorgroup;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\System;

class TeacherController extends Controller
{

    /**
     * Show the teacher dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $teacher = Auth::User()->accountable;
        $pupils = $teacher->tutorgroup->pupils()->orderBy('surname')->orderBy('forename')->paginate(20);
        return view('app.teachers.index',compact('pupils'));
    }

    /**
     * Display the individual pupil
     *
     * @param Pupil $pupil
     *
     * @return View
     */
    public function viewPupil(Pupil $pupil){

        if($pupil->tutorgroup != Auth::User()->accountable->tutorgroup){
            return redirect(route('teacher.home'))->withErrors(['That pupil is not in your tutorgroup.']);
        }

        $points = $pupil->points()->orderBy('date','DESC')->paginate(15);
        return view('app.teachers.pupil',compact('pupil','points'));
    }

    /**
     * Display the tutorgroup that the teacher owns.
     *
     * @return \Illuminate\View\View
     */
    public function viewTutorgroup(){
        $user = Auth::User();
        $tutorgroup = $user->accountable->tutorgroup;
        $competitions = $tutorgroup->competitions()->paginate(15);
        return view('app.teachers.tutorgroup',compact('competitions','tutorgroup'));
    }

    /**
     * Display the chosen competition.
     *
     * @param Competition $competition
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCompetition(Competition $competition){
        $events = $competition->events()->paginate(15);
        return view('app.teachers.competition',compact('competition','events'));
    }

    /**
     * View an event.
     *
     * @param Competition $competition
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewEvent(Competition $competition, Event $event){
        return view('app.teachers.event',compact('competition','event'));
    }

    /**
     * Show the first setup page.
     *
     * This page introduces the setup process and changes the teacher's password.
     *
     * @return View
     */
    public function setupOne(){

        return view('app.teachers.setup.one');
    }

    /**
     * Validate the input from the first setup page.
     * Change the password of the teacher.
     * Notify the teacher via email that their password has been changed.
     * Redirect to page 2 (Tutorgroup selection)
     *
     * @return View
     */
    public function setupOnePost(Request $request){
        $this->validate($request,[
            'oldpassword' => 'required|pwdcorrect',
            'password' => 'required|confirmed|min:8|max:50'
        ]);

        if($request->oldpassword == $request->password) return redirect(route('teacher.setup'))->withErrors('Your new password must be different.');

        $user = Auth::User();
        $user->password = bcrypt($request->password);
        $user->save();
        //$user->notify(new PasswordChanged());
        //Todo: Add to log.
        //Todo: Notify Teacher of Password Change.
        $request->session()->flash('setup','yes');
        return redirect(route('teacher.setup.two')); //Redirect to stage two.
    }

    /**
     * Show the second setup page.
     *
     * This page lets the teacher select their tutorgroup.
     *
     * @return View
     */
    public function setupTwo(){
        if(session('setup') != 'yes') return redirect(route('teacher.setup'));
        //Todo: This check can be forged. Change to something more secure.

        $tutorgroups = Tutorgroup::getContestantList();

        return view('app.teachers.setup.two',compact('tutorgroups'));
    }

    /**
     * Validate the input from the second setup page.
     * Associate the tutorgroup with the teacher
     * Flag the teacher as setup
     * Redirect to the teacher home.
     */
    public function setupTwoPost(Request $request){
        $this->validate($request,[
            'tutorgroup' => 'required',
        ]);
        //Todo: Add better validation. Injection vulnerability here?
        $tutorgroup = Tutorgroup::find($request->tutorgroup);
        if(!$tutorgroup){
            $request->session()->flash('setup','yes');
            return redirect(route('teacher.setup.two'));
        }
        $teacher = Auth::User()->accountable;
        $teacher->tutorgroup_id = $request->tutorgroup;
        $teacher->hasSetup = true;
        $teacher->save();
        return redirect($teacher->getHome());
    }
}
