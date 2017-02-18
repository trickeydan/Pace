<?php

namespace Tests\Feature;

use App\Models\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelTutorgroupTest extends TestCase
{
    /**
     * Test to see if Tutorgroups can be created
     *
     * @return void
     */
    public function testTutorgroupCreation()
    {
        $result = factory(Tutorgroup::class)->make();

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
        $h = factory(Tutorgroup::class)->make();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
