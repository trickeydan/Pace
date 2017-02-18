<?php

namespace App\Console\Commands\Import;

use App\Console\PaceCommand;
use App\Models\PupilPoint;
use App\Models\PupilPointType;
use Illuminate\Support\Facades\File;
use App\CSVReader as Reader;

class PointImport extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:import:points';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Import Points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import points from file';

    protected $file = 'points.csv';

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
        // Check that the file exists.
        if(!File::exists(storage_path('data/' . $this->file))) {
            $this->kill($this->file . ' does not exist. Please upload your .csv files to the storage/data directory.');
            //Todo: Report error
        }

        //Todo Make checksum of file and compare against old.
        //Todo: Save checksum to db.

        //Delete any old points
        $res = PupilPoint::getQuery()->delete();
        $this->info('Deleted ' . $res . ' points');

        //Delete any old categories
        $res = PupilPointType::getQuery()->delete();
        $this->info('Deleted ' . $res . ' point categories');

        $this->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/' . $this->file));
        $count = Reader::countRows($reader);
        $this->info('Found ' . $count . ' rows');

        $header = ["Adno","Type","Points","Date","Description","Staff Name"];

        $bar = $this->output->createProgressBar($count); //Create a symfony progress bar.

        foreach($reader->fetchAll() as $index => $row){ //Loop through every row
            if($index == 0){
                if($row != $header){ //Check that the file header contains the right things in the right order.
                    $this->kill('File header not correct.');
                    //Todo:Report error.
                }
            }else{
                $row = PupilPoint::validateData($row);
                if($row == false){
                    $this->warn('Failed to import row: ' . $index);
                    //Todo: Report Failure
                }else{
                    PupilPoint::createFromData($row);
                    //Todo: Check that it was created. Use AND/OR logic?
                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
        //Todo: Check point count matches file.
        //Todo: Report Success
    }


}
