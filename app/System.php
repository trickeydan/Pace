<?php

namespace App;


class System
{
    /**
     * This is a generic class to store system functions
     *
     * Todo: Put the system error handler in a separate class
     * Todo: Make several levels of error. e.g EXCEPTION, FATAL etc
     *
     */

    // Define some constants for error types
    // Todo: Find a better solution for this.
    const ERROR_NULLMODEL = 'A null model was found.'; // Report a null model event.
    const ERROR_NOACCOUNT = 'User has no account associated with it.'; // User doesn't have an account associated.

    /**
     * Log a system error.
     *
     * @param $type
     * @param $data
     * @param bool $die
     */
    public static function logError($type,$data,$die = true){
        //Todo: Make this store in database.
        if($die) abort(500,$type);
    }

    /**
     * Get when the database was last updated.
     *
     * @return string
     */
    public static function lastUpdated(){
        //Todo: Make this work using Uploads table
        return '30/1/80';
    }
}