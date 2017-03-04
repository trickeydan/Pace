<?php

namespace Tests\Unit\Models;

use App\Models\Pupil;
use App\Models\PupilPoint;
use App\Models\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PupilTest extends TestCase
{
    /**
     * @var Pupil;
     */
    protected $pupil;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->pupil = factory(Pupil::class)->create();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->pupil->delete();
        parent::tearDown();
    }

    /**
     * Test if the pupil can be turned into a string
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->pupil,$this->pupil->forename . ' ' . $this->pupil->surname);
    }

    /**
     * Test the getHome function
     *
     * @return void
     */
    public function testGetHome(){
        $this->assertEquals($this->pupil->getHome(),route('pupil.home'));
    }

    /**
     * Test returning of the getTypeHuman function
     *
     * @return void
     */
    public function testGetTypeHuman(){
        $this->assertEquals($this->pupil->getTypeHuman(),'Pupil');
    }

    /**
     * Test the tutorgroup relationship
     *
     * @return void
     */
    public function testTutorgroup(){
        $tg = factory(Tutorgroup::class)->create();
        $this->pupil->tutorgroup_id = $tg->id;
        $this->assertEquals($this->pupil->tutorgroup()->first()->id,$tg->id);
        $tg->delete();
    }

    /**
     * Test the PupilPoints relationship
     *
     * @return void
     */
    public function testPoints(){
        factory(PupilPoint::class,15)->create(['pupil_id' => $this->pupil->id]);
        $this->assertEquals($this->pupil->points()->count(),15);
        $this->pupil->points()->delete();
    }

    /**
     * Check that getRouteKeyName returns adno
     *
     * Todo: Ignore this test somehow!
     * @return void
     */
    public function testGetRouteKeyName(){
        $this->assertEquals($this->pupil->getRouteKeyName(),'adno');
    }

    /**
     * Check that points this week
     *
     * Todo: Change when implemented.
     * @return void
     */
    public function testPointsThisWeek(){
        $this->assertEquals($this->pupil->pointsThisWeek(),1);
    }

    /**
     * Check that best category works
     *
     * Todo: Change when implemented.
     * @return void
     */
    public function testBestCategory(){
        $this->assertEquals($this->pupil->bestCategory(),'N/I');
    }

    /**
     * Check that points are cached.
     *
     * @return void
     */
    public function testPointsCache(){
        $this->assertTrue($this->pupil->cachePoints());
    }

    /**
     * Check that password is adno
     *
     * @return void
     */
    public function testPasswordToEmail(){
        $this->assertEquals($this->pupil->getPasswordToEmail(),$this->pupil->adno);
    }

    //Todo: Add tests for validation and data creation.

    //Todo: Add test for data integrity
}
