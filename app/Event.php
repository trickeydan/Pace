<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts =[
      'affectTotals' => 'boolean',
    ];

    protected $fillable = [
        'name'
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
        return $this->eventpoints()->orderBy('amount','desc')->first()->participable->name;
    }
}
