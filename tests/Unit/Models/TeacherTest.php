<?php

namespace Tests\Unit\Models;

use App\Models\PupilPoint;
use App\Models\Teacher;
use App\Models\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherTest extends TestCase
{
    /**
     * @var Teacher;
     */
    protected $teacher;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->teacher = factory(Teacher::class)->create();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->teacher->delete();
        parent::tearDown();
    }

    /**
     * Test if the Teacher can be turned into a string
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->teacher,$this->teacher->name);
    }

    /**
     * Test the getHome function
     *
     * @return void
     */
    public function testGetHome(){
        $this->assertEquals($this->teacher->getHome(),route('teacher.home'));
    }

    /**
     * Test returning of the getTypeHuman function
     *
     * @return void
     */
    public function testGetTypeHuman(){
        $this->assertEquals($this->teacher->getTypeHuman(),'Teacher');
    }

    /**
     * Test the tutorgroup relationship
     *
     * @return void
     */
    public function testTutorgroup(){
        $tg = factory(Tutorgroup::class)->create();
        $this->teacher->tutorgroup_id = $tg->id;
        $this->assertEquals($this->teacher->tutorgroup()->first()->id,$tg->id);
        $tg->delete();
    }

    /**
     * Test the PupilPoints relationship
     *
     * @return void
     */
    public function testPoints(){
        factory(PupilPoint::class,15)->create(['teacher_id' => $this->teacher->id]);
        $this->assertEquals($this->teacher->points()->count(),15);
        $this->teacher->points()->delete();
    }

    /**
     * Test the isSetup function
     *
     * @return void
     */
    public function testIsSetup(){
        $this->assertEquals($this->teacher->isSetup(),$this->teacher->hasSetup);
    }

    /**
     * Check the setup url
     *
     * @return void
     */
    public function testSetupUrl(){
        $this->assertEquals($this->teacher->getSetupUrl(),route('teacher.setup'));
    }

    //Todo: Add validation testing
}
