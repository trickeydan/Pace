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
        return $this->belongsTo('Pace\User','user_id');
    }
    public function teacher()
    {
        return $this->belongsTo('Pace\User','teacher_id');
    }
    public function pointtype()
    {
        return $this->belongsTo('Pace\PointType');
    }
}
