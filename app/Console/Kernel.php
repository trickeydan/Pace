<?php

namespace Pace\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Pace\Console\Commands\EmailAll;
use Pace\Console\Commands\EmptyDb;
use Pace\Console\Commands\InitDb;
use Pace\Console\Commands\UpdateCache;
use Pace\Console\Commands\UpdatePoints;
use Pace\Console\Commands\UpdatePupils;
use Pace\Console\Commands\UpdateStaff;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        UpdatePupils::class,
        UpdateStaff::class,
        UpdatePoints::class,
        UpdateCache::class,
        EmptyDb::class,
        InitDb::class,
        EmailAll::class,
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
}
