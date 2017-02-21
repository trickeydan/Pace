<?php

namespace App\Console\Commands;

use App\Console\PaceCommand;
use App\Models\Pupil;
use Illuminate\Support\Facades\Hash;

class CheckDataIntegrity extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:integrity';

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
        $this->info('Checking Integrity of Pupil Data');
        $found = [];
        $bar = $this->output->createProgressBar(Pupil::all()->count() * 10);
        foreach(Pupil::all() as $pupil){
            $corrupt = false;

            //Check database fields
            $corrupt = $corrupt || is_null($pupil->forename); $bar->advance();
            $corrupt = $corrupt || is_null($pupil->surname); $bar->advance();
            $corrupt = $corrupt || is_null($pupil->currPoints); $bar->advance();
            $corrupt = $corrupt || is_null($pupil->adno); $bar->advance();
            $corrupt = $corrupt || is_null($pupil->tutorgroup_id); $bar->advance();


            $corrupt = $corrupt || is_null($pupil->tutorgroup); $bar->advance();
            $corrupt = $corrupt || is_null($pupil->user); $bar->advance();


            $corrupt = $corrupt || Hash::check($pupil->user->password,bcrypt($pupil->adno)); $bar->advance();

            $corrupt = $corrupt || $pupil->currPoints < 0; $bar->advance();

            if($corrupt) array_push($found,$pupil);
            $bar->advance();
        }
        $bar->finish();
        echo PHP_EOL;
        if(count($found) == 0){
            $this->info('No problems found.');
        }else{
            $this->warn('Found ' . count($found) . ' issues.');
            //Todo: Report
            //Todo save issues somewhere.
        }
    }
}
