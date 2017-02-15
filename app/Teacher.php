<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - string - stores the name of the teacher.
     * + initials - string
     * + tutorgroup_id - integer
     * + hasSetup - boolean
     */

    protected $casts = [
      'hasSetup' => 'boolean'
    ];

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

    /**
     * Get the tutorgroup that this teacher is part of.
     *
     * @return belongsTo
     */
    public function tutorgroup(){
        return $this->belongsTo('App\Tutorgroup');
    }

    /**
     * Has this account been setup?
     *
     * @return boolean
     */
    public function isSetup(){
        return $this->hasSetup;
    }

    /**
     * Get the setup page for this account
     *
     * @return string
     */
    public function getSetupUrl(){
        return route('teacher.setup');
    }
}
