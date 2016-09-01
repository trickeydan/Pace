<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class EmptyDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alias for migrate:refresh --seed';

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
        $this->info('PACE System Updater: Empty');
        $this->info('Reset DB: WARNING, all data is now deleted.');
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        $this->info('Seeded DB with data.');
    }
}
