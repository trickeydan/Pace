<?php

namespace Tests\Feature;

use App\PupilPoint;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModelPupilPointTest extends TestCase
{
    /**
     * Test to see if PupilPoints can be created
     *
     * @return void
     */
    public function testPupilPointCreation()
    {
        $result = factory(PupilPoint::class)->make();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if PupilPoints can be saved, deleted.
     *
     * @return void
     *
     */

    public function testPupilPointSaveDelete(){
        $p = factory(PupilPoint::class)->make();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
