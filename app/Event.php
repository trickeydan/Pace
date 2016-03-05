<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts =[
      'affectTotals' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'user_id',
        'affectTotals'
    ];

    public function eventcat()
    {
        return $this->belongsTo('Pace\EventCat');
    }

    public function eventpoints()
    {
        return $this->hasMany('Pace\EventPoint');
    }

    public function winner(){
        return "Not Implemented Yet";
    }
}
