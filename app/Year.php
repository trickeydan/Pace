<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public function tutorgroups()
    {
        return $this->hasMany('Pace\Tutorgroup');
    }

    public function updatePoints(){
        $total = 0;
        foreach($this->tutorgroups as $tg){
            $total = $total + $tg->currPoints;
        }
        $this->currPoints =  $total;
        $this->save();
    }

    public function getPoints(){
        return $this->currPoints;
    }
}
