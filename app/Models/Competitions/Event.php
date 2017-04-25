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
     * Get the winner of this event.
     *
     * @return Contestant
     */
    public function getWinner(){
        $top = $this->eventPoints()->orderBy('amount','DESC')->first();
        if($this->eventPoints()->whereAmount($top->amount)->count() > 1) return false;
        return $top->contestable;
    }

    /**
     * Get a human representation of the current winner.
     *
     * @return string
     */
    public function getWinnerHuman(){
        $winner = $this->getWinner();
        if($winner === false) return "Draw";
        return $winner->name;
    }
}
