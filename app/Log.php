<?php

namespace Pace;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['desc','user_id'];
    protected $dates = ['created_at', 'updated_at'];

    public static function log($desc){
        Log::create([
            'desc' => $desc,
            'user_id' => Auth::User()->id
        ]);
    }
}
