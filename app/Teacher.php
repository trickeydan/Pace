<?php

namespace App;

class Teacher extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - string - stores the name of the teacher.
     */

    /**
     * Get a string representation of the teacher.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the home url for the teacher
     *
     * @return string
     */
    public function getHome()
    {
        return route('teacher.home');
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
