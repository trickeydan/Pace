<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['key','value'];

    /**
     * Setup the default values
     */
    public static function setup($isSetup = false){
        if($isSetup){
            self::set('isSetup','true');
        }else{
            self::set('isSetup','false');
        }
        self::set('general_password',bcrypt('password'));
    }

    public static function set($key,$value = null){
        $entry = self::firstOrCreate(['key' => $key]);
        $entry->value = $value;
        $entry->save();
    }


    //Todo: Make neater. There was a bug preventing whereKey
    public static function get($key){
        return self::where('key','=',$key)->first()->value;
    }
}
