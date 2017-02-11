<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const PUPIL = 'App\Pupil';
    const TEACHER = 'App\Teacher';

    public function account(){
        return $this->morphOne('App\User','accountable');
    }

    public function getType(){
        return get_class($this);
    }

    public function getName(){
        return $this->name;
    }

    public function getHome(){
        return '/';
    }
}