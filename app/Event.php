<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventpoints()
    {
        return $this->hasMany('Pace\EventPoint');
    }
}
