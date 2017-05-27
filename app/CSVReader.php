<?php

namespace App;

use League\Csv\Reader;

class CSVReader extends Reader
{

    /**
     * Count the number of rows in a csv reader.
     *
     * @return int
     */
    public static function countRows($reader){
        $count = 0;
        foreach($reader->fetchAll() as $index => $row){
            $count++;
        }
        return $count;
    }
}