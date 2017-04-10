<?php

namespace App\Models\Competitions;


use App\Models\BaseModel;

abstract class Contestant extends BaseModel
{
    /**
     * Get the relationship between the contestant and competitions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function competitions(){
        return $this->morphToMany('App\Models\Competitions\Competition','contestable');
    }
}