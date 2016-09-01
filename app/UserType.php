<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function users() {
        return $this->hasMany('Pace\User','type_id');
    }

    public static function pupilID() {
        return 1;
    }
    public static function teacherID() {
        return 2;
    }
    public static function adminID() {
        return 3;
    }

    public static function pupil(){
        return UserType::find(1);
    }

    public static function teacher(){
        return UserType::find(2);
    }

    public static function admin(){
        return UserType::find(3);
    }

}
