<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

abstract class BaseModel extends Model
{
    /**
     * Get an identifier for this instance for use in debugging
     *
     * Return a base64 encoded string containing model type, id.
     *
     * @return string
     */
    public function getIdentifier(){
        $identifier = get_class($this) . ':' . $this->id;
        return base64_encode($identifier);
    }

    /**
     * Get the name of a constant from it's value
     *
     * @param $value
     * @return null|string
     */
    public function getConstantNameFromValue($const_value){
        $fooClass = new ReflectionClass ($this);
        $constants = $fooClass->getConstants();
        return array_search($const_value,$constants);
    }
}