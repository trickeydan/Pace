<?php

namespace App\Console\Commands;

use App\Console\PaceCommand;
use App\Models\Upload;
use Illuminate\Support\Facades\File;

class UploadData extends PaceCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pace:upload';

    /**
     * The title of the command
     * @var string
     */
    protected $title = 'Upload Data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload data from new files';

    /**
     * @var Upload
     */
    protected $upload;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Todo: Check to see if the system has been setup
        $this->upload = new Upload();
        $this->upload->start();
        $this->info('Upload ID: ' . $this->upload->uuid);

        if(!File::exists(storage_path('data/upload/pupils.csv')) ||
           !File::exists(storage_path('data/upload/points.csv')) ||
           !File::exists(storage_path('data/upload/staff.csv'))) {

            $this->failUpload('Missing data files. Upload failed.');
            //Todo: Remove repetition.
        }
        $this->upload->updateStatus(Upload::UPLOAD_FOUND_FILES);
        $this->info('Found data files. Moving to upload folder.');

        $new_location = storage_path('data/archive/' . $this->upload->uuid);
        if(!File::makeDirectory($new_location,0755,true)) $this->failUpload('Could not create directory.');
        File::move(storage_path('data/upload/pupils.csv'),$new_location . '/pupils.csv');
        File::move(storage_path('data/upload/points.csv'),$new_location . '/points.csv');
        File::move(storage_path('data/upload/staff.csv'),$new_location . '/staff.csv');
        $this->info('Calculating and checking MD5 hashes');
        $this->upload->updateStatus(Upload::UPLOAD_MOVED_FILES);

        $this->upload->calculateHashes($new_location);

        $hashes_unique = $this->upload->checkHashes();
        if(!$hashes_unique) {
            $this->warn('This data has been imported before.');
            $answer = $this->ask('Do you wish to continue? (yes/no)','no');
            if($answer != 'yes') $this->failUpload('This data has been uploaded before.');
            $this->upload->updateStatus(Upload::UPLOAD_VERIFIED_HASHES,'Manually overrided.');
        }else{
            $this->upload->updateStatus(Upload::UPLOAD_VERIFIED_HASHES);
        }


        $this->upload->importStaff($this);
        $this->upload->updateStatus(Upload::UPLOAD_IMPORTED_STAFF);
        $this->upload->importPupils($this);
        $this->upload->updateStatus(Upload::UPLOAD_IMPORTED_PUPILS);
        $this->upload->importPoints($this);
        $this->upload->updateStatus(Upload::UPLOAD_IMPORTED_POINTS);

        $this->call('pace:cache');
        $this->upload->updateStatus(Upload::UPLOAD_CACHED);
        $this->call('pace:integrity');
        $this->upload->updateStatus(Upload::UPLOAD_CHECKED);

        $this->upload->updateStatus(Upload::UPLOAD_SUCCESSFUL);
        $this->info('Upload complete.');
    }

    /**
     * Fail the upload, with reason and then kill the command.
     *
     * @return void
     */
    public function failUpload($message){
        //Todo: Move the files back?
        $this->upload->updateStatus(Upload::UPLOAD_ERROR,$message);
        //Todo: Email administrators about error.
        $this->kill($message);
    }
}
