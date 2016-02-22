<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function points()
    {
        return $this->hasMany('Pace\Point');
    }
}
