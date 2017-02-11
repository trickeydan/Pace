<?php

namespace App;


class System
{
    const ERROR_NULLMODEL = 'A null model was found.'; // Report a null model event.
    const ERROR_NOACCOUNT = 'User has no account associated with it.'; // User doesn't have an account associated.

    public static function logError($type,$data,$die = true){
        //Todo: Make this store in database.
        if($die) abort(500,$type);
    }

    public static function lastUpdated(){
        //Todo: Make this work using Uploads table
        return '30/1/80';
    }
}