<?php

namespace App\Console\Commands;

use App\Configuration;
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
        $this->confirmContinue();
        $this->requireGSP();
        $this->info('Resetting application.');
        $this->callSilent('migrate:refresh');
        Configuration::setup();
        $this->info('The application has been reset.');
    }
}
