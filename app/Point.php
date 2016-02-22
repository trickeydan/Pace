<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    protected $casts = [
        'date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo('Pace\User');
    }
    public function teacher()
    {
        return $this->belongsTo('Pace\Teacher');
    }
    public function pointtype()
    {
        return $this->belongsTo('Pace\PointType');
    }
}
