<?php

namespace App;


use App\Models\Account;
use App\Models\Configuration;
use App\Models\Upload;
use App\Models\User;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class System
{
    /**
     * This is a generic class to store system functions
     *
     *
     */

    /**
     * Get when the database was last updated.
     *
     * @return string
     */
    public static function lastUpdated(){
        return self::lastSuccessfulUpload()->diffForHumans();
    }

    /**
     * Get the time of the last successful upload.
     *
     * @return Carbon
     */
    public static function lastSuccessfulUpload(){
        return Upload::whereStatus(Upload::UPLOAD_SUCCESSFUL)->orderBy('created_at','DESC')->first()->created_at;
    }


    /**
     * Get the current RAM usage from the system.
     *
     * @return array
     */
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

    public static function notifyAdministrators($message){
        $users = User::whereAccountableType(Account::ADMINISTRATOR)->get();
        Notification::send($users,new AdminNotification($message));
    }
}