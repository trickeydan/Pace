<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class EventCat extends Model
{

    protected $fillable = [
      'name'
    ];

    public function events()
    {
        return $this->hasMany('Pace\Event');
    }
}
