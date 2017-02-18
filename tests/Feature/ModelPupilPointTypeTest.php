<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\PupilPointType;

class ModelPupilPointTypeTest extends TestCase
{
    /**
     * Test to see if PupilPointTypes can be created
     *
     * @return void
     */
    public function testPupilPointTypeCreation()
    {
        $result = factory(PupilPointType::class)->make();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if PupilPointTypes can be saved, deleted.
     *
     * @return void
     *
     */

    public function testPupilPointTypeSaveDelete(){
        $p = factory(PupilPointType::class)->make();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
