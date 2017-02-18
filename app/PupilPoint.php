<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PupilPoint extends Model
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

    protected $fillable = ['date','pupil_id','amount','description','teacher_id','pupil_point_type_id'];

    /**
     * Get the owning pupil of this point.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pupil(){
        return $this->belongsTo('App\Pupil');
    }


    /**
     * Get the point type of this points
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo('App\PupilPointType','pupil_point_type_id');
    }

    /**
     * Get the teacher that issued this point
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function teacher(){

        return $this->belongsTo('App\Teacher');
    }

    public static function validateData($row){
        $row[1] = preg_replace("/[^a-zA-Z ]+/", "", $row[1]);
        $row[2] = (int)$row[2];
        $row[3] = Carbon::parse($row[3]);
        $row[4] = preg_replace("/[^a-zA-Z ]+/", "", $row[4]);

        return $row;
    }

    public static function createFromData($row){
        //"Adno","Type","Points","Date","Description","Staff Name"

        $skip = false;

        if(PupilPointType::whereName($row[1])->count() == 0){
            $type = PupilPointType::createFromData($row[1]);
        }else{
            $type = PupilPointType::whereName($row[1])->first();
        }

        if(Teacher::whereName($row[5])->count() == 0){
            //Todo: Report error
            //$skip = true;
            $row[5] = strtoupper(preg_replace("/[^a-zA-Z]+/", "", $row[5]));
            $teacher = Teacher::createFromData([$row[5],'',''],false);
        }else{
            $teacher = Teacher::whereName($row[5])->first();
        }

        if(Pupil::whereAdno($row[0])->count() == 0){
            //Todo: Report error
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
