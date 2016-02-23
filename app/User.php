<?php

namespace Pace;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Encryptable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /*public function __construct()
    {
        $this->is_admin = $this->user_level == 3;
    }*/

    protected $fillable = [
        'name', 'email', 'password','pin','is_admin','adno'
    ];

    /*protected $casts = [
        'is_admin' => 'boolean',
    ];*/

    protected $encryptable = [
        'name'
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

    public function feedbacks()
    {
        return $this->hasMany('Pace\Feedback');
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

    public static function setup($email,$name,$adno){
        User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($adno),
            'adno' => $adno,
            'user_level' => 1,
        ]);
    }
}
