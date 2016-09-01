<?php

namespace Pace;

use Illuminate\Support\Facades\Crypt;


trait Encryptable
{
    //Only used on User

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable) && $this->type_id == 1) { // Pupil Only
            $value = Crypt::decrypt($value);
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable) && $this->type_id == 1) { // Pupil Only
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
}