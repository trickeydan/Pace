<?php

namespace Tests\Feature;

use App\Year;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelYearTest extends TestCase
{
    /**
     * Test to see if Years can be created
     *
     * @return void
     */
    public function testYearCreation()
    {
        $result = factory(Year::class)->make();

        $this->assertNotFalse($result);
        $result->delete();
    }

    /**
     * Test to see if Years can be saved, deleted.
     *
     * @return void
     *
     */

    public function testYearSaveDelete(){
        $h = factory(Year::class)->make();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
