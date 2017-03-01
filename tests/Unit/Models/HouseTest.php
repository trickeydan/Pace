<?php

namespace Tests\Unit\Models;

use App\Models\House;
use App\Models\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HouseTest extends TestCase
{
    /**
     * The house that is currently being tested.
     *
     * @var House
     */
    protected $house;

    /**
     * Setup the test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->house = factory(House::class)->create();
    }

    /**
     * Remove leftover data from the test
     *
     * @return void
     */
    public function tearDown()
    {
        $this->house->delete();
        parent::tearDown();
    }

    /**
     * Test the string representation of the house
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->house,$this->house->name);
    }

    /**
     * Test the relationship with tutorgroups
     *
     * @return void
     */
    public function testTutorgroups(){
        factory(Tutorgroup::class,5)->create(['house_id' => $this->house->id]);
        $this->assertEquals($this->house->tutorgroups()->count(),5);
        $this->house->tutorgroups()->delete();
    }
}
