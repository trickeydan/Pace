<?php

namespace App;


use App\Models\Configuration;
use Illuminate\Support\Facades\Hash;

class System
{
    /**
     * This is a generic class to store system functions
     *
     *
     */

    //Log Type Constants

    public static function info(){return true;}
    public static function warn(){return true;}
    public static function fatal(){return true;}

    public static function upload(){return true;} //UploadLogger Class?
    public static function security(){return true;} //Security
    public static function success(){return true;} //Security
    public static function report(){return true;} //Security


    /**
     * Get when the database was last updated.
     *
     * @return string
     */
    public static function lastUpdated(){
        //Todo: Make this work using Uploads table
        return '30/1/80';
    }

    public static function getRam(){
        $fh = fopen('/proc/meminfo','r');
        while ($line = fgets($fh)) {
            $pieces = array();
            if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                $total = $pieces[1];
            }
            if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
                $free = $pieces[1];
            }
        }
        fclose($fh);
        return [$total,$free];
    }

    /**
     * Check whether the given password is the general system password.
     *
     * @param $attempt
     * @return bool
     */
    public static function checkGeneralSystemPassword($attempt){
        return Hash::check($attempt,Configuration::get('general_password'));
    }
}