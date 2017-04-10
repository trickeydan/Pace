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


    /**
     * Get the relationship for the contestants, regardless of the type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function contestants(){
        if($this->contestable_type == Tutorgroup::class){
            return $this->tutorgroups();
        }else{
            return $this->houses();
        }
    }

    /**
     * The polymorphic relationship to Tutorgroups
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tutorgroups(){
        return $this->morphedByMany('App\Models\Tutorgroup','contestable');
    }

    /**
     * The polymorphic relationship to houses
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function houses(){
        return $this->morphedByMany('App\Models\House','contestable');
    }




    /**
     * Get the events in this competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(){
        return $this->hasMany('App\Models\Competitions\Event');
    }

    /**
     * Get the current winner
     *
     * @return string
     */
    public function currentWinner(){
        return 'N/I';
    }
}
