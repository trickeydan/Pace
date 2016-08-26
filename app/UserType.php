<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function users() {
        return $this->hasMany('Pace\User');
    }
}
