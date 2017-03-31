<?php

namespace App\Console\Commands;

use App\Console\PaceCommand;
use App\Models\Pupil;
use App\Models\PupilPoint;
use App\System;
use Illuminate\Support\Facades\Hash;

class CheckDataIntegrity extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:integrity {--quick}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the integrity of data in the database';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Data Integrity Check';

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
        $this->info('Checking All Data');
        $this->down('Checking data integrity.');
        $found = [];
        array_merge($found,$this->checkPupils());
        array_merge($found,$this->checkPoints());
        //Add teacher checks
        //Add PointsType Check
        //Add Admin Check
        //Add TG Checks
        //Add Year Checks
        //Add House checks
        //Add User checks

        if(count($found) == 0){
            $this->info('No problems found.');
        }else{
            $this->warn('Found ' . count($found) . ' issues.');
            //Todo save issues somewhere.
        }
        $this->callSilent('up');
    }

    /**
     * Check the integrity of the pupil data
     *
     * @return array
     */
    private function checkPupils(){
        $found = [];
        if($this->option('quick')) $this->info('Quick Mode. Hash checking disabled.');

        $bar = $this->output->createProgressBar(Pupil::all()->count());
        $this->info('Checking Integrity of Pupil Data');
        foreach(Pupil::all() as $pupil){
            $corrupt = $pupil->checkIntegrity($bar);
            if(!$this->option('quick')) { $corrupt = $corrupt || Hash::check($pupil->user->password,bcrypt($pupil->adno)); $bar->advance(); }
            if($corrupt) array_push($found,$pupil);
            $bar->advance();
        }
        $bar->finish();
        echo PHP_EOL;
        return $found;
    }

    /**
     * Check the integrity of the point data.
     *
     * @return array
     */
    public function checkPoints(){
        $found = [];
        $bar = $this->output->createProgressBar(PupilPoint::all()->count());
        $this->info('Checking Integrity of PupilPoint Data');
        foreach(PupilPoint::all() as $point){
            $corrupt = $point->checkIntegrity();
            if($corrupt) array_push($found,$point);
            $bar->advance();
        }
        $bar->finish();
        echo PHP_EOL;
        return $found;
    }
}
