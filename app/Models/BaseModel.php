<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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
}