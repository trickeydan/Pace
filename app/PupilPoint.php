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
     * + (teacher_id - ID of the issuing teacher)
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
     * @return PointType
     */
    public function type(){
        //Todo: Make this class and implement.
        return 'N/I';
    }

    /**
     * Get the teacher that issued this point
     */

    public function teacher(){
        //Todo: Relationship
        return 'Mr E. Example';
    }
}
