<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\System;

class PupilPoint extends BaseModel
{
    /*
     * Fields in this model:
     * + date - date of point issue
     * + pupil_id - ID of the pupil
     * + amount - Amount of points
     * + description - Point text.
     * + teacher_id - ID of the issuing teacher
     * + pupil_point_type_id
     */

    /**
     * The fillable fields for this model. See Laravel docs.
     *
     * @var array
     */
    protected $fillable = ['date','pupil_id','amount','description','teacher_id','pupil_point_type_id'];

    /**
     * Get the owning pupil of this point.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pupil(){
        return $this->belongsTo('App\Models\Pupil');
    }


    /**
     * Get the point type of this points
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo('App\Models\PupilPointType','pupil_point_type_id');
    }

    /**
     * Get the teacher that issued this point
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function teacher(){

        return $this->belongsTo('App\Models\Teacher');
    }

    /**
     * Validate and Format the data for import.
     *
     * @param $row
     * @return mixed
     */
    public static function validateData($row){
        //Todo: Add validation

        //Format
        //
        $row[1] = preg_replace("/[^a-zA-Z ]+/", "", $row[1]);
        $row[2] = (int)$row[2];
        $row[3] = Carbon::parse($row[3]);
        $row[4] = preg_replace("/[^a-zA-Z ]+/", "", $row[4]);

        return $row;
    }

    /**
     * Create a point from data from import.
     *
     * Will create PointType, Teacher if not existing.
     *
     * @param $row
     * @return int
     */
    public static function createFromData($row){
        //"Adno","Type","Points","Date","Description","Staff Name"

        $skip = false;

        if(PupilPointType::whereName($row[1])->count() == 0){
            $type = PupilPointType::createFromData($row[1]);
        }else{
            $type = PupilPointType::whereName($row[1])->first();
        }

        if(Teacher::whereName($row[5])->count() == 0){
            System::warn();
            //$skip = true;
            $teacher = Teacher::createFromData([$row[5],'',''],false);
        }else{
            $teacher = Teacher::whereName($row[5])->first();
        }

        if(Pupil::whereAdno($row[0])->count() == 0){
            System::warn();
            $skip = true;
        }else{
            $pupil = Pupil::whereAdno($row[0])->first();
        }

        if($skip){
            echo PHP_EOL . "Skipping";
            echo var_dump($row);
            echo PHP_EOL . PHP_EOL;
            return 0;
        }

        return PupilPoint::create([
            'date' => $row[3],
            'pupil_id' => $pupil->id,
            'amount' => $row[2],
            'description' => $row[4],
            'teacher_id' => $teacher->id,
            'pupil_point_type_id' => $type->id,
        ]);
    }
}
