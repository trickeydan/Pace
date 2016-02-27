<?php
namespace Pace;

use Illuminate\Support\Facades\Mail;

class ImportManager
{

    public static function cache(){

        foreach(User::all() as $user){
            $user->updatePoints();
        }

        foreach(House::all() as $house){
            $house->updatePoints();
        }

        foreach(Tutorgroup::all() as $tg){
            $tg->updatePoints();
        }

        foreach(Year::all() as $y){
            $y->updatePoints();
        }
    }

    public static function sendEmailReminder()
    {

        Mail::send('emails.test', [], function ($m) {
            $m->from('hello@app.com', 'Your Application');

            $m->to('mail@mail.com', 'User')->subject('Your Reminder!');
        });
    }
}