<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Pace\ImportManager;

class UpdateCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the points cache';

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
        $this->info('PACE System Updater: Cache');
        $this->info('Activating maintenance mode');
        Artisan::call('down');
        ImportManager::cache();
        $this->info('Cache Updated');
        Artisan::call('up');
    }
}
