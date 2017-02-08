<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    /**
     * Return the Tutorgroups in this year
     *
     * @return Tutorgroup
     */

    public function tutorgroups(){
        return $this->hasMany('App\Tutorgroup');
    }
}
