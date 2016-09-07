<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;
use Pace\Year;

class Tutorgroup extends Model
{

    public static function getTG($initials){ //i.e GTH
        foreach (Year::all() as $year){
            foreach ($year->tutorgroups as $tg){
                if (substr($tg->name,-3,3) == $initials){
                    return $tg;
                }
            }
        }
        return false;
    }


    protected $table='tutorgroups';

    public function users()
    {
        return $this->hasMany('Pace\User');
    }

    public function year()
    {
        return $this->belongsTo('Pace\Year');
    }

    public function updatePoints(){
        $total = 0;
        foreach($this->users as $user){
            $total = $total + $user->currPoints;
        }
        $this->currPoints =  $total;
        foreach($this->eventpoints as $ep){
            if($ep->event->affectTotals) $this->currpoints += $ep->amount;
        }
        $this->save();
    }

    public function getPoints(){
        return $this->currPoints;
    }

    public function eventpoints()
    {
        return $this->morphMany('Pace\EventPoint', 'participable');
    }
}
