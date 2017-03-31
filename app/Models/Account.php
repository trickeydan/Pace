<?php

namespace App\Models;

use App\System;
use Illuminate\Database\Eloquent\Model;

abstract class Account extends BaseModel
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
     * Return the string representation of this user.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

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
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Get a human-readable string for the account type
     *
     *
     * @return string
     */
    abstract public function getTypeHuman();


    /**
     * Return the name of the home for this account.
     *
     * @return string
     */
    abstract public function getHome();

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
     * @parm $bool
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
        $user->save();
        return $user;
    }
}