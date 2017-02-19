<?php

namespace App\Exceptions;


class PaceException extends \Exception
{

    const GENERIC = 0;
    const NULL_TUTORGROUP = 101;
    const NULL_YEAR = 102;
    const NULL_HOUSE = 103;
    const CMD_ERROR = 104;
    const USER_NO_ACCOUNT = 105;
    const OVERRIDEN_CODE_EXECUTED = 106;
    const INCONSISTENT_DATA = 107;
    const HOUSE_NOT_SETUP = 108;

    // Redefine the exception so message isn't optional
    public function __construct($data, $code = 0, Exception $previous = null) {

        if(method_exists($data,'getIdentifier')){
            $message = "Error " . $code . ": " . $data->getIdentifier();
        }else{
            $message = "Error " . $code;
        }

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}