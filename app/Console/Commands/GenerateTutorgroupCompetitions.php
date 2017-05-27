<?php

namespace App\Console\Commands;

use App\Console\PaceCommand;
use App\Models\Competitions\Competition;
use App\Models\Tutorgroup;
use App\Models\Year;
use Illuminate\Console\Command;

class GenerateTutorgroupCompetitions extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:tgchallenge';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Generate TG Challenges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the competitions for tutorgroup challenges';

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
        foreach (Year::all() as $year){
            $this->info('Generating ' . $year->name);
            $competition = Competition::create([
                'title' => $year->name . ' Tutorgroup Challenge',
                'contestable_type' => Tutorgroup::class,
            ]);
            foreach ($year->tutorgroups as $tg){
                $competition->contestants()->attach($tg);
            }
        }
    }
}
