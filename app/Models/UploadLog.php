<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadLog extends BaseModel
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

    //Todo: Remove repetition of above


    protected $fillable = ['message','status'];


    /**
     * Get the relationship for the upload that this log belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Upload
     */
    public function upload(){
        return $this->belongsTo('App\Models\Upload');
    }

    /**
     * Get a human-readable version of the status
     *
     * Todo: Get rid of repetition of this code. It is repeated in Upload.php. Perhaps use a trait?
     *
     * @return String
     */
    public function getStatus(){
        return self::getConstantNameFromValue($this->status);
    }
}
