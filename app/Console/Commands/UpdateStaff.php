<?php

namespace Pace\Console\Commands;

use Illuminate\Console\Command;
use Pace\User;
use Pace\UserType;
use Illuminate\Support\Facades\Artisan;
use League\Csv\Reader;
use Illuminate\Database\Eloquent\Model;

class UpdateStaff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:staff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the staff data from staff.csv';

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
        $this->info('PACE System Updater:Staff Data');
        $this->info('Activating maintenance mode');
        Artisan::call('down');
        $res = UserType::teacher()->users()->delete();
        $this->info('Deleted ' . $res . ' teachers');

        $datalocation = storage_path('staff.csv');
        $this->info('Loading new Teachers');
        $this->info('Loading data from ' . $datalocation);

        $reader = Reader::createFromPath($datalocation);
        $results = $reader->fetchAssoc();
        Model::unguard();
        $counter = 0;
        foreach ($results as $row) {

            User::create([
                'name' => $row["Staff Name"],
                'email' => $row["Staff Email"],
                'type_id' => UserType::teacherID(),
                'password' => bcrypt('klbteacher' . $row["Initials"]),
                'initials' => $row["Initials"],
            ]);


            $counter++;
        }
        Model::reguard();
        $this->info('Total:' . $counter);
        $this->info('Staff Data updated.');
        Artisan::call('up');
    }
}
