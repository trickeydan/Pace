<?php

namespace App\Console\Commands\Import;

use App\Console\PaceCommand;
use App\Teacher;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class TeacherImport extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:import:teachers';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Import Teachers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import teachers from file.';

    protected $file = 'staff.csv';

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

        $res = Teacher::getQuery()->delete();
        $this->info('Deleted ' . $res . ' teachers');


        $this->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/' . $this->file));
        $count = $this->countRows($reader);
        $this->info('Found ' . $count . ' rows');
        $header = ["Full Name","Work Email","Initials"];

        $bar = $this->output->createProgressBar($count);

        foreach($reader->fetchAll() as $index => $row){
            if($index == 0){
                if($row != $header){
                    $this->kill('File header not correct.');
                    //Todo:Report error.
                }
            }else{
                $row = Teacher::validateData($row);
                if($row == false){
                    $this->warn('Failed to import row: ' . $index);
                    //Todo: Report Failure
                }else{
                    Teacher::createFromData($row);

                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
        //Todo: Check teacher count matches file.
        //Todo: Report Success
    }

    private function countRows($reader){
        //Todo: move this somewhere more appropriate. Perhaps extend reader.
        //Todo: Remove duplicate.
        $count = 0;
        foreach($reader->fetchAll() as $index => $row){
            $count++;
        }
        return $count;
    }
}
