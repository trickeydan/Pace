<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class PointType extends Model
{
    public function points()
    {
        return $this->hasMany('Pace\Point');
    }
}
