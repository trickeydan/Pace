<?php

namespace App\Models\Competitions;

use App\Models\BaseModel;

class EventPoint extends BaseModel
{
    protected $fillable = ['amount','contestable_type','contestable_id'];

    /**
     * Get the event that this point belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(){
        return $this->belongsTo('App\Models\Competition\Event');
    }

    /**
     * Get the contestant that owns these points.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contestable(){
        return $this->morphTo();
    }
}
