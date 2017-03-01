<?php

namespace App\Console\Commands\Import;

use App\Console\PaceCommand;
use App\Models\Pupil;
use Illuminate\Support\Facades\File;
use App\CSVReader as Reader;
use App\System;

class PupilImporter extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:import:pupils';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Import pupils';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Pupils from pupils.csv';

    /**
     * The file that contains the pupil import.
     *
     * @var string
     */
    protected $file = 'pupils.csv';

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
        System::success();//Import start
        //Check that the file exists
        if(!File::exists(storage_path('data/' . $this->file))) {
            System::fatal();//Import failed
            $this->kill($this->file . ' does not exist. Please upload your .csv files to the storage/data directory.');
        }

        //Delete old pupils
        $res = Pupil::getQuery()->delete();
        $this->info('Deleted ' . $res . ' pupils');

        $this->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/' . $this->file));
        $count = Reader::countRows($reader);
        $this->info('Found ' . $count . ' rows');
        $header = ["Adno","Email","Forename","Surname","Reg","House","Year"];

        $bar = $this->output->createProgressBar($count);

        foreach($reader->fetchAll() as $index => $row){
            if($index == 0){
                if($row != $header){
                    System::fatal();//Import failed
                    $this->kill('File header not correct.');
                }
            }else{
                $row = Pupil::validateData($row);
                if($row == false){
                    System::fatal();//Import failed
                    $this->warn('Failed to import row: ' . $index);
                }else{
                    Pupil::createFromData($row);

                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
        //Todo: Check pupil count matches file.
        //Todo: Report Success
        System::upload();//Import success
    }
}
