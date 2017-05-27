<?php

namespace Tests\Unit\Models;

use App\Models\Pupil;
use App\Models\PupilPoint;
use App\Models\PupilPointType;
use App\Models\Teacher;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PupilPointTest extends TestCase
{
    /**
     * The data being used to test the system.
     *
     * @var PupilPoint
     */
    protected $point;

    /**
     * Setup the test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->point = factory(PupilPoint::class)->create();
    }

    /**
     * Clear up test data
     *
     * @return void
     */
    public function tearDown()
    {
        $this->point->delete();
        parent::tearDown();
    }

    /**
     * Test the pupil relationship
     *
     * @return void
     */
    public function testPupil(){
        $pupil = factory(Pupil::class)->create();
        $this->point->pupil_id = $pupil->id;
        $this->point->save();
        $this->assertEquals($this->point->pupil()->first()->id,$pupil->id);
        $pupil->delete();
    }

    /**
     * Test the PupilPointType relationship
     *
     * @return void
     */
    public function testPupilPointType(){
        $ppt = factory(PupilPointType::class)->create();
        $this->point->pupil_point_type_id = $ppt->id;
        $this->point->save();
        $this->assertEquals($this->point->type()->first()->id,$ppt->id);
        $ppt->delete();
    }

    /**
     * Test the Teacher relationship
     *
     * @return void
     */
    public function testTeacher(){
        $teacher = factory(Teacher::class)->create();
        $this->point->teacher_id = $teacher->id;
        $this->point->save();
        $this->assertEquals($this->point->teacher()->first()->id,$teacher->id);
        $teacher->delete();
    }

    // Todo: Add data validation tests
}
