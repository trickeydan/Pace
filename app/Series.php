<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{

    protected $table = 'series';

    protected $fillable = [
        'name',
        'affectTotals',
        'binary',
        'awardedTo'
    ];

    protected $casts = [
      'affectTotals' => 'boolean',
      'binary' => 'boolean',
    ];

    public function events()
    {
        return $this->hasMany('Pace\Event');
    }

    public function awardToNice(){
        $conversions = [
            'user' => 'Pupils',
            'tutorgroup' => 'Tutor Groups',
            'house' => 'Houses'
        ];
        return $conversions[$this->awardedTo];
    }

    public function winner(){
        $arr = array();
        foreach($this->events as $e){
            foreach($e->eventpoints as $ep){
                if(isset($arr[$ep->participable->name])){
                    $arr[$ep->participable->name] += $ep->amount;
                }else{
                    $arr[$ep->participable->name] = $ep->amount;
                }

            }
        }
        arsort($arr);
        return each($arr)['key'];
    }
}
