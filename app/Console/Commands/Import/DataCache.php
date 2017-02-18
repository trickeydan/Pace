<?php

namespace App\Console\Commands\Import;

use App\Console\PaceCommand;
use App\Pupil;
use App\Tutorgroup;

class DataCache extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:cache';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Cache the data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the Points data.';

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
        $this->info('Step 1 of 2: Cache Pupil data');
        $bar = $this->output->createProgressBar(Pupil::all()->count());
        foreach (Pupil::all() as $pupil){
            $pupil->cachePoints();
            $bar->advance();
        }
        $bar->finish();
        echo PHP_EOL;

        $this->info('Step 2 of 2: Cache Tutorgroup data');
        $bar = $this->output->createProgressBar(Tutorgroup::all()->count());
        foreach (Tutorgroup::all() as $tg){
            $tg->cachePoints();
            $bar->advance();
        }
        $bar->finish();
        echo PHP_EOL;

        $this->info('Cache complete.');
    }
}
