<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * This is a base class for any account.
     *
     * It defines the relationships to allow the user instance to access it.
     *
     * It has no fields in the databases.
     *
     * An instance of Account should never be created.
     */

    // Define some constants for the account types.
    const PUPIL = 'App\Pupil';
    const TEACHER = 'App\Teacher';
    const ADMINISTRATOR = 'App\Administrator';

    /**
     * Return the user that this belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function account(){
        return $this->morphOne('App\User','accountable');
    }

    /**
     * Return the class type of this account
     *
     * Todo: replace this with is_type(Account::PUPIL) etc
     *
     * @return string
     */
    public function getType(){
        return get_class($this);
    }

    /**
     * Return the name of this account.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }


    /**
     * Return the name of the home for this account.
     *
     * Never actually used as all accounts should override this function.
     *
     * @return string
     */
    public function getHome(){
        return '/';
    }
}