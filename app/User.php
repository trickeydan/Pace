<?php

namespace Pace;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Encryptable;

    protected $fillable = [
        'name', 'email', 'password','pin','is_admin','id'
    ];

    protected $encryptable = [
        'name',
        'email'
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

    public function pointsThisWeek(){
        $dt = new \DateTime();
        $dt->sub(new \DateInterval('P7D'));
        return \Pace\Point::where('user_id',$this->id)->where('date','>',$dt)->sum('amount');
    }

    public function updatePoints(){
        $this->currPoints = $this->points->sum('amount');
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

    public function eventpoints()
    {
        return $this->morphMany('Pace\EventPoint', 'participant');
    }

    public function sendPin(){
        Mail::send('emails.pin', ['user' => $this], function ($m) {
            $m->from(env('email'), 'KLBS Pace Points');

            $m->to($this->email, $this->name)->subject('Your Pin');
        });
    }

}
