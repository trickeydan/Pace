<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['name','slug'];

    public function users()
    {
        return $this->hasMany('Pace\User');
    }

    public function getPoints(){

        return $this->currPoints;
    }

    public function updatePoints(){
        $total = 0;
        foreach($this->users as $user){
            $total = $total + $user->currPoints;
        }
        $this->currPoints = $total;
        foreach($this->eventpoints as $ep){
            if($ep->affectTotals) $this->currpoints += $ep->amount;
        }
        $this->save();
    }

    public function eventpoints()
    {
        return $this->morphMany('Pace\EventPoint', 'participable');
    }

}
