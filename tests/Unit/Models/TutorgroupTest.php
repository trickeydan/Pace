<?php

namespace Tests\Unit\Models;

use App\Models\House;
use App\Models\Pupil;
use App\Models\Tutorgroup;
use App\Models\Year;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TutorgroupTest extends TestCase
{
    /**
     * @var Tutorgroup;
     */
    protected $tutorgroup;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->tutorgroup = factory(Tutorgroup::class)->create();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->tutorgroup->delete();
        parent::tearDown();
    }

    /**
     * Test if the tutorgroup can be turned into a string
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->tutorgroup,$this->tutorgroup->name);
    }

    /**
     * Test the relationship with pupils
     *
     * @return void
     */
    public function testPupils(){
        factory(Pupil::class,5)->create(['tutorgroup_id' => $this->tutorgroup->id]);
        $this->assertEquals($this->tutorgroup->pupils()->count(),5);
        $this->tutorgroup->pupils()->delete();
    }

    /**
     * Test the relationship with the house
     *
     * @return void
     */
    public function testHouse(){
        $house = factory(House::class)->create();
        $this->tutorgroup->house_id = $house->id;
        $this->assertEquals($this->tutorgroup->house()->first()->id,$house->id);
        $house->delete();
    }

    /**
     * Test the relationship with the year
     *
     * @return void
     */
    public function testYear(){
        $year = factory(Year::class)->create();
        $this->tutorgroup->year_id = $year->id;
        $this->assertEquals($this->tutorgroup->year()->first()->id,$year->id);
        $year->delete();
    }

    /**
     * Test points this week
     *
     *
     * @return void
     */
    public function testPointsThisWeek(){
        $this->assertEquals($this->tutorgroup->pointsThisWeek(),0);
    }

    /**
     * Test Tutorgroup position
     *
     * Todo: Make a better test
     *
     * @return void
     */
    public function testGetPosition(){
        //$this->assertNotNull($this->tutorgroup->getPosition());
    }

    /**
     * Test Tutorgroup position ordinal
     *
     * Todo: Make a better test
     *
     * @return void
     */
    public function testGetOrdinalPosition(){
        //$this->assertNotNull($this->tutorgroup->getOrdinalPosition());
    }

    //Todo: Add test for cache
    //Todo: Add test for validation and creation

}
