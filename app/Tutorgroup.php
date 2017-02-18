<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorgroup extends Model
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
        return $this->hasMany('App\Pupil');
    }

    /**
     * Get the house of this tutorgroup.
     *
     * @return House
     */
    public function house(){
        return $this->belongsTo('App\House');
    }

    /**
     * Get the Year of this tutorgroup.
     *
     * @return Year
     */

    public function year(){
        return $this->belongsTo('App\Year');
    }

    /**
     * Get the number of points obtained this week.
     *
     * @return int
     */
    public function pointsThisWeek(){
        //Todo: Add query to do this.
        return 1;
    }

    /**
     * Get the position in the year as an integer
     *
     * @return int
     */
    public function getPosition(){
        //Todo: Add this
        return 1;
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

    public static function createFromData($name,$house,$year){

        if(Year::whereName($year)->count() == 0){
            $year = Year::create(['name' => $year]);
            //Todo: check if saved.
        }else{
            $year = Year::whereName($year)->first();
        }

        if(House::whereName($house)->count() == 0){
            throw \Exception;
            //Todo: Report failure
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
}
