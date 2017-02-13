<?php

namespace App;

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
}
