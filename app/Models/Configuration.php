<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends BaseModel
{

    /**
     * The fields that are fillable. See Laravel docs.
     *
     * @var array
     */
    protected $fillable = ['key','value'];

    //Todo: Use magic methods?

    /**
     * Setup the database configuration
     *
     * Insert values in the database configuration that are needed to setup.
     *
     * Todo: Load from config file?
     *
     * @param bool $isSetup
     */
    public static function setup($isSetup = false){
        if($isSetup){
            self::set('isSetup','true');
        }else{
            self::set('isSetup','false');
        }
        self::set('general_password',bcrypt('password'));
    }

    /**
     * Set the configuration value
     *
     * Change or insert the configuration value in the database.
     *
     * @param $key
     * @param null $value
     */
    public static function set($key,$value = null){
        $entry = self::firstOrCreate(['key' => $key]);
        $entry->value = $value;
        $entry->save();
    }


    /**
     * Get the configuration value
     *
     * Fetch the configuration value from the database
     *
     * Todo: Make neater. There was a bug preventing whereKey
     *
     * @param $key
     * @return mixed
     */
    public static function get($key){
        return self::where('key','=',$key)->first()->value;
    }
}
