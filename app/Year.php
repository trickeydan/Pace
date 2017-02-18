<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    /*
     * Fields in this model:
     * + name - string - stores the name of the year.
     */

    protected $fillable = ['name'];


    /**
     *  Get the string representation of a Year.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }


    /**
     * Return the Tutorgroups in this year
     *
     * @return hasMany
     */

    public function tutorgroups(){
        return $this->hasMany('App\Tutorgroup');
    }
}
