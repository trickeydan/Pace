<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /*
     * Fields in this model:
     * (+ All fields on App\Account)
     * + name - String - stores the name of the pupil
     */

    public function __toString()
    {
        return $this->name;
    }


    /**
     * Get the points that this teacher has issued.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(){
        return $this->hasMany('App\PupilPoint');
    }
}
