<?php

namespace Tests\Unit\Models;

use App\Models\Year;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class YearTest extends TestCase
{
    /**
     * @var Year;
     */
    protected $year;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->year = factory(Year::class)->create();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->year->delete();
        parent::tearDown();
    }

    /**
     * Temp test
     */
    public function testExample(){
        $this->assertTrue(true);
    }

    /**
     * Test if the Year can be turned into a string
     *
     * @return void
     *
     * Todo: Fix this test.
     *
     */
    /*public function testToString(){
        $this->assertEquals((string)$this->year,$this->year->name);
    }*/
}
