<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Account
{
    /*
     * Fields in this model:
     * + All fields on App\Account
     * + name - string - stores the name of the teacher.
     * + initials - string
     * + tutorgroup_id - integer
     * + hasSetup - boolean
     */

    protected $fillable = ['name','initials'];

    protected $casts = [
      'hasSetup' => 'boolean'
    ];

    /**
     * Get a string representation of the teacher.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the home url for the teacher
     *
     * @return string
     */
    public function getHome()
    {
        return route('teacher.home');
    }


    /**
     * Get the points that this teacher has issued.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(){
        return $this->hasMany('App\PupilPoint');
    }

    /**
     * Get the tutorgroup that this teacher is part of.
     *
     * @return belongsTo
     */
    public function tutorgroup(){
        return $this->belongsTo('App\Tutorgroup');
    }

    /**
     * Has this account been setup?
     *
     * @return boolean
     */
    public function isSetup(){
        return $this->hasSetup;
    }

    /**
     * Get the setup page for this account
     *
     * @return string
     */
    public function getSetupUrl(){
        return route('teacher.setup');
    }

    public static function validateData($row){
        //todo:validate data
        //Initials 3 chars etc


        //Format data
        $row[0] = preg_replace("/[^a-zA-Z ]+/", "", $row[0]);
        $row[2] = strtoupper(preg_replace("/[^a-zA-Z]+/", "", $row[2]));
        return $row;
    }

    public static function createFromData($row,$makeuser = true){
        //"Full Name","Work Email","Initials"
        $teacher = self::create([
            'name' => $row[0],
            'initials' => $row[2],
        ]);

        if($makeuser){
            if(User::whereEmail($row[1])->count() == 0){
                $teacher->makeUser($row[1],$row[0]);
                //Todo: Choose better passwords
                //Todo: Email teachers?
            }else{
                $user = User::whereEmail($row[1])->first();

                if($user->accountable_type != Account::TEACHER){
                    throw \Exception;
                    //Todo: Report failure
                }else{
                    $user->accountable_id = $teacher->id;
                    $user->save();
                    //Todo: Check
                }
            }
        }
        return $teacher;
    }
}
