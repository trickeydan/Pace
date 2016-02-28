<?php
namespace Pace;

use Illuminate\Support\Facades\Mail;

class ImportManager
{

    public static function cache(){

        foreach(User::all() as $user){
            $user->updatePoints();
        }

        foreach(House::all() as $house){
            $house->updatePoints();
        }

        foreach(Tutorgroup::all() as $tg){
            $tg->updatePoints();
        }

        foreach(Year::all() as $y){
            $y->updatePoints();
        }
    }

    public static function initialMail()
    {

        foreach(User::where('user_level',1)->get() as $user){
            $user->sendPin();
        }
    }
}