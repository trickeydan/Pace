<?php

namespace App\Models;

use App\System;
use Illuminate\Database\Eloquent\Model;

class Account extends BaseModel
{
    /**
     * This is a base class for any account.
     *
     * It defines the relationships to allow the user instance to access it.
     *
     * It has no fields in the databases.
     *
     * An instance of Account should never be created.
     */

    // Define some constants for the account types.
    const PUPIL = Pupil::class;
    const TEACHER = Teacher::class;
    const ADMINISTRATOR = Administrator::class;

    /**
     * Return the user that this belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function user(){
        return $this->morphOne('App\Models\User','accountable');
    }

    /**
     * Return the class type of this account
     *
     * Todo: replace this with is_type(Account::PUPIL) etc
     * Todo: This should be in the User?
     *
     * @return string
     */
    public function getType(){
        return get_class($this);
    }

    /**
     * Return the name of this account.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Get a human-readable string for the account type
     *
     * This is to be overrided, so will return the type.
     *
     * @return string
     */
    public function getTypeHuman(){
        return $this->getType();
    }


    /**
     * Return the name of the home for this account.
     *
     * Never actually used as all accounts should override this function.
     *
     * @return string
     */
    public function getHome(){
        return '/';
    }

    /**
     * Has this account been setup?
     *
     * @return boolean
     */
    public function isSetup(){
        return true;
    }

    /**
     * Get the setup page for this account
     *
     * @return string
     */
    public function getSetupUrl(){
        return $this->getHome();
    }

    /**
     * Get the password to send to the user in a forgot password situation.
     *
     * @return mixed
     */
    public function getPasswordToEmail(){
        System::warn();
        return 'not available. Please contact system administrator.';
    }


    /**
     * Creates and saves a user that is associated with this account.
     *
     * @param $email
     * @param $password
     *
     * @return User
     */
    public function makeUser($email,$password,$bool = true){
        $user = new User();
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->accountable_type = $this->getType();
        $user->accountable_id = $this->id;
        if($bool) return $user->save();
        return $user;
    }
}