<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class EventPoint extends Model
{
    public function event()
    {
        return $this->belongsTo('Pace\Event');
    }

    public function participants(){
        return $this->morphTo();
    }

}
