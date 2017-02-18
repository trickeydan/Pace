<?php

namespace App\Models;

class Administrator extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Models\Account
     * + name - String - stores the name of the administrator.
     */

    /**
     * An array of fields that are fillable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the home url for the administrator.
     *
     * @return string
     */
    public function getHome()
    {
        return route('admin.home');
    }

    /**
     * Get a human-readable string for the account type
     *
     * @return string
     */
    public function getTypeHuman(){
        return 'Administrator';
    }

    /**
     * Does this account receive email alerts?
     *
     * @return boolean
     */
    public function receivesAlerts(){
        //Todo: Do this in the database.
        return false;
    }
}
