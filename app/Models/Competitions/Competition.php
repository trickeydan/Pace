<?php

namespace App\Models\Competitions;

use App\Models\House;
use App\Models\Tutorgroup;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = ['title','contestable_type'];

    /**
     * Get an array of models that are allowed to compete.
     *
     * @return array
     */
    public static function getValidContestants(){
        return [
            Tutorgroup::class => 'Tutorgroup',
            House::class => 'House'
        ];
    }

    /**
     * Get the type of model that competes in a human readable format
     *
     * @return string
     */
    public function contestantTypeHuman(){
        return self::getValidContestants()[$this->contestable_type];
    }

    public function contestants(){
        return ['N/I'];
    }

    /**
     * Get the events in this competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(){
        return $this->hasMany('App\Models\Competitions\Event');
    }
}
