<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{

    protected $table = 'series';

    protected $fillable = [
      'name'
    ];

    public function events()
    {
        return $this->hasMany('Pace\Event');
    }

    public function awardToNice(){
        return $this->awardTo;
    }
}
