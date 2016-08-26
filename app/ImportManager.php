<?php
namespace Pace;

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
        foreach(UserType::pupil()->users as $user){
            if($user->hasLoggedIn()){
                $user->sendPin();
            }
        }
    }
}