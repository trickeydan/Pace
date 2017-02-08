<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorgroup extends Model
{
    /*
     * Fields in this model:
     * + name - String - stores the name of the tutorgroup. e.g 10CUJ
     * + currPoints - integer - stores the total cached points of this tutorgroup.
     */

    /**
     * Magic Method for casting as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }


    /**
     * Retrieve the pupils in this tutorgroup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pupils(){
        return $this->hasMany('App\Pupil');
    }

    /**
     * Get the house of this tutorgroup.
     *
     * @return House
     */
    public function house(){
        return $this->belongsTo('App\House');
    }

    /**
     * Get the Year of this tutorgroup.
     *
     * @return Year
     */

    public function year(){
        return $this->belongsTo('App\Year');
    }
}
