<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts =[
      'affectTotals' => 'boolean',
    ];

    public function series()
    {
        return $this->belongsTo('Pace\Series');
    }

    public function eventpoints()
    {
        return $this->hasMany('Pace\EventPoint');
    }

    public function winner(){
        return "Not Implemented Yet";
    }
}
