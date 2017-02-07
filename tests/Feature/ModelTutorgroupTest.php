<?php

namespace Tests\Feature;

use App\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelTutorgroupTest extends TestCase
{
    /**
     * Creates a Tutorgroup for testing
     *
     * @return Tutorgroup
     */

    public static function createTutorgroup(){
        $faker = Faker::create();

        return Tutorgroup::create();
    }


    /**
     * Test to see if Tutorgroups can be created
     *
     * @return void
     */
    public function testTutorgroupCreation()
    {
        $result = self::createTutorgroup();

        $this->assertNotFalse($result);
        $result->delete();
    }

    /**
     * Test to see if Tutorgroups can be saved, deleted.
     *
     * @return void
     *
     */

    public function testTutorgroupSaveDelete(){
        $h = self::createTutorgroup();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
