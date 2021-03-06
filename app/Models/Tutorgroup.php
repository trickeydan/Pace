<?php

namespace App\Models;

use App\Models\Competitions\Contestant;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\PaceException;
use App\System;
use Carbon\Carbon;

class Tutorgroup extends Contestant
{
    /*
     * Fields in this model:
     * + name - String - stores the name of the tutorgroup. e.g 10CUJ
     * + currPoints - integer - stores the total cached points of this tutorgroup.
     */

    protected $fillable = ['name','currPoints'];

    /**
     * Magic Method for casting as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }


    /**
     * Retrieve the pupils in this tutorgroup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pupils(){
        return $this->hasMany('App\Models\Pupil');
    }

    /**
     * Get the house of this tutorgroup.
     *
     * @return House
     */
    public function house(){
        return $this->belongsTo('App\Models\House');
    }

    /**
     * Get the Year of this tutorgroup.
     *
     * @return Year
     */

    public function year(){
        return $this->belongsTo('App\Models\Year');
    }

    /**
     * Get the points that the pupils in this tutorgroup have.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function points(){
        return $this->hasManyThrough('App\Models\PupilPoint','App\Models\Pupil');
    }

    /**
     * Get the number of points obtained this week.
     *
     * @return int
     */
    public function pointsThisWeek(){
        return $this->points()->where('date','>',Carbon::today()->subWeek())->sum('amount');
    }

    /**
     * Get the position in the year as an integer
     *
     * @return int
     */
    public function getPosition(){
       return $this->year->tutorgroups()->where('currPoints','>=',$this->currPoints)->count();
    }

    /**
     * Get the position in the year as an ordinal string.
     *
     * @return string
     */
    public function getOrdinalPosition(){
        $num = $this->getPosition();
        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }
        return $num.'th';
    }

    /**
     * Cache the points for the tutorgroup.
     *
     * @return bool
     */
    public function cachePoints(){
        $this->currPoints = $this->pupils()->sum('currPoints');
        return $this->save();
    }

    /**
     * Create a tutorgroup from data for import.
     *
     * Todo: Add validation
     *
     * @param $name
     * @param $house
     * @param $year
     * @return mixed
     */
    public static function createFromData($name,$house,$year){

        if(Year::whereName($year)->count() == 0){
            $year = Year::create(['name' => $year]);
            //Todo: check if saved.
        }else{
            $year = Year::whereName($year)->first();
        }

        if(House::whereName($house)->count() == 0){
            throw new PaceException($house,PaceException::INCONSISTENT_DATA);
        }else{
            $house = House::whereName($house)->first();
        }

        $tg = self::create([
            'name' => $name,
            'currPoints' => 0
        ]);
        $tg->year_id = $year->id;
        $tg->house_id = $house->id;
        $tg->save();
        //Todo: Check if saved.
        return $tg;
    }

    /**
     * Get a list of tutorgroups for use in contestant form.
     *
     * @return array
     */
    public static function getContestantList(){
        $tutorgroups = [];

        foreach (Year::orderBy('name')->get() as $year){
            $group = [];
            foreach($year->tutorgroups()->orderBy('name')->get() as $tg){
                $group[$tg->id] = $tg->name;
            }
            $tutorgroups[$year->name] = $group;
        }
        return $tutorgroups;
    }
}
