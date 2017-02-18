<?php

namespace App\Console\Commands\Import;

use App\Console\PaceCommand;
use App\Pupil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

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
        if(!File::exists(storage_path('data/' . $this->file))) {
            $this->kill($this->file . ' does not exist. Please upload your .csv files to the storage/data directory.');
            //Todo: Report error
        }

        //Todo Make checksum of file and compare against old.
        //Todo: Save checksum to db.

        $res = Pupil::getQuery()->delete();
        $this->info('Deleted ' . $res . ' pupils');

        $this->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/' . $this->file));
        $count = $this->countRows($reader);
        $this->info('Found ' . $count . ' rows');
        $header = ["Adno","Email","Forename","Surname","Reg","House","Year"];

        $bar = $this->output->createProgressBar($count);

        foreach($reader->fetchAll() as $index => $row){
            if($index == 0){
                if($row != $header){
                    $this->kill('File header not correct.');
                    //Todo:Report error.
                }
            }else{
                $row = Pupil::validateData($row);
                if($row == false){
                    $this->warn('Failed to import row: ' . $index);
                    //Todo: Report Failure
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
    }

    private function countRows($reader){
        //Todo: move this somewhere more appropriate. Perhaps extend reader.
        $count = 0;
        foreach($reader->fetchAll() as $index => $row){
            $count++;
        }
        return $count;
    }
}