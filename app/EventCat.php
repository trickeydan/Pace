<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class EventCat extends Model
{
    public function events()
    {
        return $this->hasMany('Pace\Event');
    }
}