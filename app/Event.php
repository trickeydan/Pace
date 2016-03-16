<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts =[
      'affectTotals' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'user_id',
        'affectTotals'
    ];

    public function series()
    {
        return $this->belongsTo('Pace\Series');
    }

    public function eventpoints()
    {
        return $this->hasMany('Pace\EventPoint');
    }

    public function winner(){
        $top =  $this->eventpoints()->orderBy('amount','desc')->first();
        $all = $this->eventpoints()->whereAmount($top->amount);
        if($all->count() > 1){
            $text = "Draw: ";
            foreach($all->get() as $ep){
                $text = $text . $ep->participable->name . " ";
            }
            return $text;
        }else{
            return $top->participable->name;
        }
    }
}
