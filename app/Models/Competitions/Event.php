<?php

namespace App\Models\Competitions;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title'];
    /**
     * Get the competition that this event is part of.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition(){
        return $this->belongsTo('App\Models\Competitions\Competition');
    }

    /**
     * Get the event points that were awarded in this competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventPoints(){
        return $this->hasMany('App\Models\Competitions\EventPoint');
    }

    /**
     * Get a human representation of the current winner.
     *
     * @return string
     */
    public function getWinnerHuman(){
        return 'N/I';
    }
}
