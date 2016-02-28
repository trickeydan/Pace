<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventcat()
    {
        return $this->belongsTo('Pace\EventCat');
    }

    public function eventpoints()
    {
        return $this->hasMany('Pace\EventPoint');
    }
}
