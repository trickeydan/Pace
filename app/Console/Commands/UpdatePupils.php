<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use League\Csv\Reader;
use Pace\House;
use Pace\Tutorgroup;
use Pace\User;
use Pace\UserType;
use Pace\Year;

class UpdatePupils extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:pupils';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the pupil data from pupils.csv';

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
        $this->info('PACE System Updater: Pupil Data');
        $this->info('Activating maintenance mode');
        Artisan::call('down');
        $res = UserType::pupil()->users()->delete();
        $this->info('Deleted ' . $res . ' pupils');

        $datalocation = storage_path('pupils.csv');
        $this->info('Loading new Pupils');
        $this->info('Loading data from ' . $datalocation);

        $reader = Reader::createFromPath($datalocation);
        $results = $reader->fetchAssoc();
        Model::unguard();
        $counter = 0;
        foreach ($results as $row) {

            $tg = Tutorgroup::whereName($row["Reg"]);
            if($tg->count() <= 0){


                $year = Year::whereName($row["Year"]);
                if($year->count() <= 0){
                    $this->comment('Creating Year: ' . $row["Year"]);
                    $year = Year::create(['name' => $row["Year"], 'currPoints' => 0]);
                }else{
                    $year = $year->first();
                }

                $this->comment('Creating TG: ' . $row["Reg"]);

                $tg = Tutorgroup::create([
                    'name' => $row["Reg"],
                    'year_id' => $year->id,
                    'currPoints' => 0
                ]);
            }else{
                $tg = $tg->first();
            }

            User::create([
                'id' => $row["Adno"],
                'type_id' => UserType::pupilID(),
                'name' => $row["Forename"] . ' ' . $row["Surname"],
                'email' => $row["Email"],
                'password' => bcrypt(substr($row["Adno"],2,4)),

                'tutorgroup_id' => $tg->id,
                'house_id'  => House::whereName($row["House"])->first()->id,
                'currPoints' => 0,
            ]);
            $counter++;
        }
        Model::reguard();
        $this->info('Total:' . $counter);
        $this->info('Pupil Data updated.');
        $this->info('Now Run Cache Updater & Points Loader');
        Artisan::call('up');
    }
}
