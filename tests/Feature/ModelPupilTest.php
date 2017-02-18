<?php

namespace Tests\Feature;

use App\Models\Pupil;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelPupilTest extends TestCase
{
    /**
     * Test to see if Pupils can be created
     *
     * @return void
     */
    public function testPupilCreation()
    {
        $result = factory(Pupil::class)->make();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if Pupils can be saved, deleted.
     *
     * @return void
     *
     */

    public function testPupilSaveDelete(){
        $p = factory(Pupil::class)->make();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
