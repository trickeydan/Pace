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

    public static function background(){
        $date = date('j-n');
        dd(easter_date());
        if($date == '4-11' || $date == '5-11'){
            return 'bonfire.jpg';
        }
        elseif (date('n') == 12 && date('j') >= 10 && date('j') < 26){
            return 'xmas.jpg';
        }
        else{
            return 'normal.jpg';
        }
    }
}