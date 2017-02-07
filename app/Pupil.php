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
     * + currPoints - integer - stores the cached points of this account.
     */
}
