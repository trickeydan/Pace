<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PupilPointType extends Model
{
    /*
     * Fields in this model:
     * + name - String - the name to display
     */

    /**
     * Return a string representation of this model
     */

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the points of this type.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function points(){
        return $this->hasMany('App\PupilPoint');
    }
}
