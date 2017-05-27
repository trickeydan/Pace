<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PupilPointType extends BaseModel
{
    /*
     * Fields in this model:
     * + name - String - the name to display
     */

    protected $fillable = ['name'];

    /**
     * Return a string representation of this model
     */

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the points of this type.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function points(){
        return $this->hasMany('App\Models\PupilPoint');
    }

    /**
     * Create a type from data
     *
     * NB: Assume validated data.
     * Todo: Add validation.
     *
     * @param $name
     * @return mixed
     */
    public static function createFromData($name){
        return self::create(['name' => $name]);
    }
}
