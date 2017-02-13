<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * Get the home for the administrator
     */
    public function getHome()
    {
        return route('admin.home');
    }

}
