<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'positive',
        'negative',
        'general',
    ];

    public function user()
    {
        return $this->belongsTo('Pace\User');
    }
}
