<?php

namespace App\Console;

use App\Console\Commands\CheckDataIntegrity;
use App\Console\Commands\Import\DataCache;
use App\Console\Commands\Import\PointImport;
use App\Console\Commands\Import\PupilImporter;
use App\Console\Commands\Import\TeacherImport;
use App\Console\Commands\ResetApplication;
use App\Console\Commands\SetupApplication;
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

        PupilImporter::class,
        TeacherImport::class,
        PointImport::class,
        DataCache::class,


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
