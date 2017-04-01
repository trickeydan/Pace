<?php

namespace App\Models\Competitions;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Get the competition that this event is part of.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition(){
        return $this->belongsTo('App\Models\Competition\Competition');
    }

    public function getWinnerHuman(){
        return 'N/I';
    }
}
