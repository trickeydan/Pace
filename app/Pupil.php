<?php

namespace App;


class Pupil extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - String - stores the name of the pupil
     * + currPoints - integer - stores the cached points of this pupil.
     */

    /**
     * Get the home url of the pupil
     *
     * @return string
     */
    public function getHome()
    {
        return route('pupil.home');
    }

    /**
     * Get the tutorgroup that this belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutorgroup(){
        return $this->belongsTo('App\Tutorgroup');
    }

    /**
     * Get this pupils PupilPoints
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(){
        return $this->hasMany('App\PupilPoint');
    }

    /**
     * Tell the implicit route model binding logic to use the adno column to identify a model
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'adno';
    }

    /**
     * Return the name of this account.
     *
     * @return string
     */
    public function getName(){
        return $this->forename . ' ' . $this->surname;
    }

    /**
     * Get the number of points obtained this week.
     *
     * @return int
     */
    public function pointsThisWeek(){
        //Todo: Add query to do this.
        return 1;
    }

    /**
     * Get the best category for this pupil.
     *
     * @return string
     */
    public function bestCategory(){
        //Todo: Add a query to do this. Or perhaps do in caching?
        return 'N/I';
    }
}
