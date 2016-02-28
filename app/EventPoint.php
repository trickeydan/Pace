<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class EventPoint extends Model
{

    protected $table = 'event_points';

    public function event()
    {
        return $this->belongsTo('Pace\Event');
    }

    public function participable(){
        return $this->morphTo();
    }

}
