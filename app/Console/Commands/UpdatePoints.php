<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Model;
use Pace\Point;
use League\Csv\Reader;
use Pace\PointType;
use Pace\User;
use Pace\UserType;

class UpdatePoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the points data from points.csv';

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
        $this->info('PACE System Updater:Point Data');
        $this->info('Activating maintenance mode');
        Artisan::call('down');
        $this->info('Deleted ' . Point::all()->count() . ' points');
        Point::truncate();

        $datalocation = storage_path('points.csv');
        $this->info('Loading new Points');
        $this->info('Loading data from ' . $datalocation);

        $reader = Reader::createFromPath($datalocation);
        $results = $reader->fetchAssoc();
        Model::unguard();
        $counter = 0;
        foreach ($results as $row) {
            $pupil = User::find($row["Adno"]);

            $teacher = UserType::teacher()->users()->whereName($row["Staff Name"])->first();

            if(PointType::whereName($row["Type"])->count() <=0){
                $type = PointType::create([
                    'name' => $row["Type"]
                ]);
                $this->comment('Made new PointType: ' . $row["Type"]);
            }else{
                $type = PointType::whereName($row["Type"])->first();
            }
            Point::create([
                'user_id' => $pupil->id,
                'teacher_id' => $teacher->id,
                'pointtype_id'  => $type->id,
                'amount'    => $row["Points"],
                'description'   => $row["Description"],
                'date'  => $row["Date"],
            ]);

            $counter++;
        }
        Model::reguard();
        $this->info('Total:' . $counter);
        $this->info('Points Data updated.');
        Artisan::call('up');
    }
}
