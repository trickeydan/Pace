<?php

namespace App\Console\Commands;

use App\Models\Administrator;
use App\Models\Configuration;
use App\Console\PaceCommand;
use App\Models\House;
use App\Models\User;
use App\Models\Account;

class SetupApplication extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:setup';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Setup PACE Points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the system.';

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
        $this->info('Welcome to the ' . config('app.name') . ' setup.');


        $this->info('Setting up database.');
        $this->callSilent('migrate:refresh');
        Configuration::setup();

        $this->info('Firstly, we need to set the General System Password.');
        $gsp = $this->secret('Please provide a general system password.');
        Configuration::set('general_password',bcrypt($gsp));
        $this->info('The general system password has now been set. This will be required for future command line maintenance.');

        //Make administrators.
        $this->info('An administrator account is required.');
        $name = $this->ask('Admin Name: ');
        $email = $this->ask('Admin Email: ');
        $password = $this->secret('Admin Password: ');

        //Create a new administrator
        $admin = Administrator::create(['name' => $name]);
        User::create([
            'accountable_type' => Account::ADMINISTRATOR,
            'accountable_id' => $admin->id,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        //Todo: Email administrator with welcome email.

        $this->info('We now need to setup the database.');

        $this->info('Setting up houses.');
        $this->warn('This cannot be changed at a later date. Please double check spelling.');
        $number = $this->ask('How many houses are needed?',4);
        for($i = 1;$i <= $number;$i++){
            $this->info('House ' . $i);
            $name = strtoupper($this->ask('Name for House ' . $i));
            $colour = strtoupper($this->ask('Colour for House #' . $i,'555555'));
            House::create(['name' => $name,'colour' => $colour]);
        }
        //Todo: Add a check to see if the houses were created successfully.
        $this->info('Houses created.');

        $this->info('Importing pupils via script.');
        $this->call('pace:import:pupils');

        $this->info('Importing teachers via script.');
        $this->call('pace:import:teachers');

        $this->info('Importing points via script.');
        $this->call('pace:import:points');



        //Todo: Rollback on failure.

        $this->info('Caching data via script.');
        $this->call('pace:cache');

        $this->info('Opening the system to web access.');
        Configuration::set('isSetup','true');
        $this->info('Setup is now complete.');
        System::info();//App Setup
    }
}
