<?php

namespace app;


class System
{
    const ERROR_NULLMODEL = 'A null model was found.'; // Report a null model event.

    public static function logEvent($type,$data){
        //Todo: Make this store in database.
        abort(500,$type);
    }

    public static function lastUpdated(){
        //Todo: Make this work using Uploads table
        return '30/1/80';
    }
}