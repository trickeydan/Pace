<?php

namespace Pace;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Encryptable;

    protected $fillable = [
        'name', 'email', 'password','pin','user_level','id'
    ];

    protected $encryptable = [
        'name',
    ];

    protected $hidden = [
        'password', 'remember_token','pin'
    ];

    public function getRouteKeyName()
    {
        return 'email';
    }

    public function tutorgroup()
    {
        return $this->belongsTo('Pace\Tutorgroup');
    }

    public function house()
    {
        return $this->belongsTo('Pace\House');
    }

    public function points()
    {
        return $this->hasMany('Pace\Point');
    }

    public function eventpoints()
    {
        return $this->morphMany('Pace\EventPoint', 'participable');
    }

    public function type(){
        return $this->belongsTo('Pace\UserType');
    }

    public function pointsThisWeek(){
        $dt = new \DateTime();
        $dt->sub(new \DateInterval('P7D'));
        return \Pace\Point::where('user_id',$this->id)->where('date','>',$dt)->sum('amount');
    }

    public function updatePoints(){
        $this->currPoints = $this->points->sum('amount');
        foreach($this->eventpoints as $ep){
            if($ep->event->affectTotals) $this->currpoints += $ep->amount;
        }
        $this->save();
    }

    public function getPoints(){
        return $this->currPoints;
    }

    public function is_pupil(){
        return $this->user_level == 1;
    }

    public function is_teacher(){
        return $this->user_level == 2;
    }

    public function is_admin(){
        return $this->user_level == 3;
    }

    public function homeUrl(){
        if($this->is_pupil()){
            return route('home');
        }elseif($this->is_teacher()) {
            return route('teacher.home');
        }else{
            return route('admin.home');
        }

    }


    public function sendPin(){

        Mail::send('emails.pin', ['user' => $this], function ($m) {
            $m->from('pace@klbschool.net', 'KLBS Pace Points');

            $m->to($this->email, $this->name)->subject('You haven\' logged in yet!');
        });
    }

    public function hasLoggedIn(){
        return Log::whereUserID($this->id)->count() != 0;
    }

}
