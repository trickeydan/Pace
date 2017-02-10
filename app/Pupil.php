<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class Pupil extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - String - stores the name of the pupil
     * + currPoints - integer - stores the cached points of this pupil.
     */

    /**
     * Get the tutorgroup that this belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutorgroup(){
        return $this->belongsTo('App\Tutorgroup');
    }

    /**
     * Get this pupil's house.
     *
     * DEPRECATED. Access via tutorgroup model instead.
     *
     * @return House
     */

    public function house(){
        //Todo: Remove this code.
        trigger_error('Should access House via Tutorgroup model',E_USER_WARNING);
        return $this->tutorgroup->house;
    }

    /**
     * Get this pupils PupilPoints
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(){
        return $this->hasMany('App\PupilPoint');
    }
}