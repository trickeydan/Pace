<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    /**
     *  Get the string representation of a Year.
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }


    /**
     * Return the Tutorgroups in this year
     *
     * @return Tutorgroup
     */

    public function tutorgroups(){
        return $this->hasMany('App\Tutorgroup');
    }
}
