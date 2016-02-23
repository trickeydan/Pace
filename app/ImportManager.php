<?php
namespace Pace;

class ImportManager
{

    public static function cache(){
        foreach(User::where('user_level',3)->get() as $user){
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
}