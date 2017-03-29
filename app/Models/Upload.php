<?php

namespace App\Models;

use App\Console\Commands\UploadData;
use App\Console\PaceCommand;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\CSVReader as Reader;

class Upload extends BaseModel
{
    const UPLOAD_START = 0;
    const UPLOAD_FOUND_FILES = 1;
    const UPLOAD_MOVED_FILES = 2;
    const UPLOAD_CALCULATED_HASHES = 3;
    const UPLOAD_VERIFIED_HASHES = 4;

    const UPLOAD_IMPORTED_STAFF = 5;
    const UPLOAD_IMPORTED_PUPILS = 6;
    const UPLOAD_IMPORTED_POINTS = 7;

    const UPLOAD_CACHED = 8;

    const UPLOAD_CHECKED = 9;

    const UPLOAD_SUCCESSFUL = 10;


    const UPLOAD_ERROR = 100;

    protected $fillable = ['status'];

    /**
     * Start Upload
     *
     * Adds a UUID to the object.
     * Sets the status to UPLOAD_START
     *
     */
    public function start(){
        $this->uuid = uniqid();
        //Todo: Add check to ensure that uniqid is unique as it is not always.
        $this->save();
        $this->updateStatus(self::UPLOAD_START);
    }

    /**
     * Get the relationship for the logs for this upload.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|UploadLog
     */
    public function logs(){
        return $this->hasMany('App\Models\UploadLog');
    }

    /**
     * Get a human-readable version of the upload string.
     *
     * @return null|string
     */
    public function getStatus(){
        return self::getConstantNameFromValue($this->status);
    }

    /**
     * Tell the framework which field to use for implicit route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Update the status and log the new status.
     *
     * @param $status
     * @param string $message
     */
    public function updateStatus($status,$message = ''){
        $this->logs()->create([
            'message' => $message,
            'status'  => $status
        ]);
        $this->status = $status;
        $this->save();
    }


    /**
     * Fail the upload.
     *
     * @param $message
     *
     * @return void
     */
    public function fail($message){
        $this->updateStatus(self::UPLOAD_ERROR,$message);
    }

    /**
     * Calculate and store the hashes for the data
     *
     * @param $hash
     * @return void
     */
    public function calculateHashes($location){
        $this->pupils_hash = md5_file($location . '/pupils.csv');
        $this->staff_hash = md5_file($location . '/staff.csv');
        $this->points_hash = md5_file($location . '/points.csv');
        $this->save();
        $this->updateStatus(self::UPLOAD_CALCULATED_HASHES);
    }

    /**
     * Check if any other uploads have the same hashes as this upload
     *
     * If they do, return false.
     *
     * @return bool
     */
    public function checkHashes(){
        //Todo: Check this upload has hashes.

        /*$bool = Upload::wherePupilsHash($this->pupils_hash)->count() == 1;
        $bool = $bool && Upload::whereStaffHash($this->staff_hash)->count() == 1;
        $bool = $bool && Upload::wherePointsHash($this->points_hash)->count() == 1;

        It only matters if the points hasn't changed as the pupil and staff data will often be identical.

        */

        //Todo: Check only where upload was successful.

        return Upload::wherePointsHash($this->points_hash)->count() == 1;
    }

    /**
     * Import the staff from the file.
     *
     * @param UploadData $command
     */
    public function importStaff($command){
        //Delete all teachers.
        $res = Teacher::getQuery()->delete();
        $command->info('Deleted ' . $res . ' teachers');


        $command->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/archive/' . $this->uuid . '/staff.csv'));
        $count = Reader::countRows($reader);
        $command->info('Found ' . $count . ' rows');
        $header = ["Full Name","Work Email","Initials"];

        $bar = $command->createProgressBar($count);

        foreach($reader->fetchAll() as $index => $row){
            if($index == 0){
                if($row != $header){
                    $command->failUpload('File header not correct.');
                }
            }else{
                $row = Teacher::validateData($row);
                if($row == false){
                    $command->warn('Failed to import row: ' . $index);
                }else{
                    Teacher::createFromData($row);
                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
        //Todo: Check teacher count matches file.
    }

    /**
     * Import pupil data from the file
     *
     * @param UploadData $command
     */
    public function importPupils($command){
        //Delete old pupils
        $res = Pupil::getQuery()->delete();
        $command->info('Deleted ' . $res . ' pupils');

        $command->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/archive/' . $this->uuid . '/pupils.csv'));
        $count = Reader::countRows($reader);
        $command->info('Found ' . $count . ' rows');
        $header = ["Adno","Email","Forename","Surname","Reg","House","Year"];

        $bar = $command->createProgressBar($count);

        foreach($reader->fetchAll() as $index => $row){
            if($index == 0){
                if($row != $header){
                    $command->failUpload('File header not correct.');
                }
            }else{
                $row = Pupil::validateData($row);
                if($row == false){
                    $this->warn('Failed to import row: ' . $index);
                }else{
                    Pupil::createFromData($row);

                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
    }

    /**
     * Import point data from the file
     *
     * @param UploadData $command
     */
    public function importPoints($command){
        //Delete any old points
        $res = PupilPoint::getQuery()->delete();
        $command->info('Deleted ' . $res . ' points');

        //Delete any old categories
        $res = PupilPointType::getQuery()->delete();
        $command->info('Deleted ' . $res . ' point categories');

        $command->info('Beginning import.');
        $reader = Reader::createFromPath(storage_path('data/archive/' . $this->uuid . '/points.csv'));
        $count = Reader::countRows($reader);
        $command->info('Found ' . $count . ' rows');

        $header = ["Adno","Type","Points","Date","Description","Staff Name"];

        $bar = $command->createProgressBar($count); //Create a symfony progress bar.

        foreach($reader->fetchAll() as $index => $row){ //Loop through every row
            if($index == 0){
                if($row != $header){ //Check that the file header contains the right things in the right order.
                    $command->failUpload('File header not correct.');
                }
            }else{
                $row = PupilPoint::validateData($row);
                if($row == false){
                    $command->warn('Failed to import row: ' . $index);
                }else{
                    PupilPoint::createFromData($row);
                    //Todo: Check that it was created. Use AND/OR logic?
                }

                $bar->advance();
            }
        }
        $bar->finish();
        echo PHP_EOL;
    }
}
