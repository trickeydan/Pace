<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /*
     * Fields in this model:
     * + name - String - stores the name of the House. e.g Berkeley
     * + colour - String - Hexadecimal representation of the house colour. Include #. i.e #556e40
     */

    protected $fillable = ['name','colour'];

    /**
     * Magic Method
     *
     * Get the string representation of a House.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the tutorgroups that belong in this house.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tutorgroups(){
        return $this->hasMany('App\Models\Tutorgroup');
    }
}
