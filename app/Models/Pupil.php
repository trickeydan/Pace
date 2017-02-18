<?php

namespace App\Models;


class Pupil extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Models\Account
     * + forename - String - stores the name of the pupil
     * + surname - String - stores the name of the pupil
     * + currPoints - integer - stores the cached points of this pupil.
     * + adno
     * + tutorgroup_id
     */

    protected $fillable = ['forename','surname','currPoints','adno','tutorgroup_id'];

    /**
     * Get the home url of the pupil
     *
     * @return string
     */
    public function getHome()
    {
        return route('pupil.home');
    }

    /**
     * Get the tutorgroup that this belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutorgroup(){
        return $this->belongsTo('App\Models\Tutorgroup');
    }

    /**
     * Get this pupils PupilPoints
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(){
        return $this->hasMany('App\Models\PupilPoint');
    }

    /**
     * Tell the implicit route model binding logic to use the adno column to identify a model
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'adno';
    }

    /**
     * Return the name of this account.
     *
     * @return string
     */
    public function getName(){
        return $this->forename . ' ' . $this->surname;
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
     * Get the best category for this pupil.
     *
     * @return string
     */
    public function bestCategory(){
        //Todo: Add a query to do this. Or perhaps do in caching?
        return 'N/I';
    }

    /**
     * Cache the points for this pupil.
     *
     * @return bool
     */
    public function cachePoints(){
        $this->currPoints = $this->points()->sum('amount');
        return $this->save();
    }


    /**
     * Validate the data on import
     *
     * Check and validate the pupil data.
     * Not suitable for data integrity check.
     *
     * @param $row
     * @return mixed
     */
    public static function validateData($row){
        //Todo: Validate email etc

        if(strlen($row[0]) == 6){

            if(substr($row[0],0,2) == "00"){
                $adno = substr($row[0],2,4);
            }else{
                //Todo: Report bad adno
                return false;
            }

        }elseif(strlen($row[0]) == 4){
            $adno = $row[0];
        }else{
            //Todo: Report bad adno
            return false;
        }


        //Format data

        $row[0] = (string)$adno;
        $row[1] = strtolower($row[1]);
        $row[2] = preg_replace("/[^a-zA-Z]+/", "", $row[2]);
        $row[3] = preg_replace("/[^a-zA-Z]+/", "", $row[3]);
        $row[4] = strtoupper($row[4]);
        $row[5] = strtoupper($row[5]);
        $row[6] = strtoupper($row[6]);
        return $row;
    }

    /**
     * Create a pupil from the given data
     *
     * NB: Requires data to be validated elsewhere
     *
     * Will create Tutorgroup and other associated models if not existing.
     *
     * @param $row
     */
    public static function createFromData($row){
        //"Adno","Email","Forename","Surname","Reg","House","Year"

        if(Tutorgroup::whereName($row[4])->count() == 0){
            $tutorgroup = Tutorgroup::createFromData($row[4],$row[5],$row[6]);
        }else{
            $tutorgroup = Tutorgroup::whereName($row[4])->first();
        }

        $pupil = self::create([
            'forename' => $row[2],
            'surname'  => $row[3],
            'adno'     => $row[0],
            'currPoints' => 0,
            'tutorgroup_id' => $tutorgroup->id,
        ]);

        if(User::whereEmail($row[1])->count() == 0){
            $pupil->makeUser($row[1],$row[0]);
        }else{
            $user = User::whereEmail($row[1])->first();

            if($user->accountable_type != Account::PUPIL){
                throw \Exception;
                //Todo: Report failure
            }else{
                $user->accountable_id = $pupil->id;
                $user->save();
                //Todo: Check
            }
        }
    }
}
