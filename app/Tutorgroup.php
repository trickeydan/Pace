<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Tutorgroup extends Model
{

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
            if($ep->affectTotals) $this->currpoints += $ep->amount;
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
