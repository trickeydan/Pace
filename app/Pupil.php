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
     * @return House
     */

    public function house(){
        //Todo: Use a many-through relationship here
        return 'House';
    }
}
