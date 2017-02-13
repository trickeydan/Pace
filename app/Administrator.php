<?php

namespace App;

class Administrator extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - String - stores the name of the administrator.
     */

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

}
