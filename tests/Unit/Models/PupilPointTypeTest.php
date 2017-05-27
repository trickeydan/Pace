<?php

namespace Tests\Unit\Models;

use App\Models\PupilPoint;
use App\Models\PupilPointType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PupilPointTypeTest extends TestCase
{
    /**
     * The data being used to test the system.
     *
     * @var PupilPointType
     */
    protected $type;

    /**
     * Setup the test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->type = factory(PupilPointType::class)->create();
    }

    /**
     * Clear up test data
     *
     * @return void
     */
    public function tearDown()
    {
        $this->type->delete();
        parent::tearDown();
    }

    /**
     * Test the string representation
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->type,$this->type->name);
    }

    /**
     * Test the PupilPoints relationship
     *
     * @return void
     */
    public function testPoints(){
        factory(PupilPoint::class,15)->create(['pupil_point_type_id' => $this->type->id]);
        $this->assertEquals($this->type->points()->count(),15);
        $this->type->points()->delete();
    }
}
