<?php

namespace App\Console;

use App\Console\Commands\CheckDataIntegrity;
use App\Console\Commands\DataCache;
use App\Console\Commands\GenerateTutorgroupCompetitions;
use App\Console\Commands\ResetApplication;
use App\Console\Commands\SetupApplication;
use App\Console\Commands\UploadData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ResetApplication::class,
        SetupApplication::class,
        CheckDataIntegrity::class,

        DataCache::class,

        UploadData::class,
        GenerateTutorgroupCompetitions::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
