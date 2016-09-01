<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialise Database';

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

        $this->info('PACE System Updater: Initialiser');
        Artisan::call('pace:staff');
        Artisan::call('pace:pupils');
        Artisan::call('pace:points');
        Artisan::call('pace:cache');
        $this->info('Database initialised.');
    }
}
