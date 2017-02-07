<?php

namespace Tests\Feature;

use App\Pupil;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelPupilTest extends TestCase
{
    /**
     * Creates a Pupil for testing
     *
     * @return Pupil
     */

    public static function createPupil(){
        return factory(Pupil::class)->make();
    }


    /**
     * Test to see if Pupils can be created
     *
     * @return void
     */
    public function testPupilCreation()
    {
        $result = self::createPupil();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if Pupils can be saved, deleted.
     *
     * @return void
     *
     */

    public function testPupilSaveDelete(){
        $p = self::createPupil();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
