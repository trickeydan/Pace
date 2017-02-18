<?php

namespace App\Console\Commands;

use App\Models\Configuration;
use App\Console\PaceCommand;

class ResetApplication extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:reset';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Reset Application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the application';

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
        $this->info('This action will delete all data without recovery.');
        $this->confirmContinue(); // Ask the user if they would like to continue.
        $this->requireGSP(); //Ask for and check the GSP
        $this->info('Resetting application.');
        $this->callSilent('migrate:refresh'); // Reset the database.
        Configuration::setup(); //Populate configuration values.
        $this->info('The application has been reset.');
    }
}
