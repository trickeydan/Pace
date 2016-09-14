<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Pace\User;
class EmailAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email all users with passwords';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (User::all() as $user){
            $user->sendEmail();
        }
    }
}
