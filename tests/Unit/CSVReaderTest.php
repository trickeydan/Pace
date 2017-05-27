<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use SplTempFileObject;
use App\CSVReader;

class CSVReaderTest extends TestCase
{
    /**
     * @var CSVReader
     */
    private $csv;

    private $expected = [
        ['john', 'doe', 'john.doe@example.com'],
        ['jane', 'doe', 'jane.doe@example.com'],
    ];

    /**
     * Setup the test data.
     *
     * @return void
     */
    public function setUp()
    {
        $tmp = new SplTempFileObject();
        foreach ($this->expected as $row) {
            $tmp->fputcsv($row);
        }
        $this->csv = CSVReader::createFromFileObject($tmp);
    }

    /**
     * Remove the test data once finished.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->csv = null;
    }

    public function testCountLines(){
        $this->assertEquals(2,CSVReader::countRows($this->csv));
    }
}
