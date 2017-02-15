<?php

namespace App;

use App\Notifications\sendPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //Todo: All emails sent add to the log (except bulk for which only one is added).

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the user their password if they have requested a reset.
     *
     * Whilst it says reset, the token functionality has been disabled to prevent pupils from changing their passwords.
     *
     * @var $token
     *
     * @return void
     */

    public function sendPasswordResetNotification($token) // In this case $token is always null to maintain the inheritance from the framework.
    {
        $this->notify(new sendPassword($this->getPasswordToEmail()));
    }

    /**
     * Get the password to send to the email address in the event of a password reset.
     *
     * @return string
     */

    public function getPasswordToEmail(){
        // Todo: Add a check to see if teacher or pupil. Then return adno or abort safe
        return 'Not implemented';
    }

    /**
     * Get the name to display
     *
     * @return string
     *
     */
    public function getName(){

        return $this->accountable->getName();
    }

    /**
     * Retrieve this user's account. i.e a pupil, teacher.
     *
     * @return Pupil
     * @return Teacher
     * @return Administrator
     *
     * //Todo: Use a magic method so that $user->pupil etc can be used
     *
     */
    public function accountable(){
        return $this->morphTo();
    }

}
