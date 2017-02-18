<?php

namespace Tests\Feature;

use App\Models\House;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelHouseTest extends TestCase
{
    /**
     * Test to see if Houses can be created
     *
     * @return void
     */
    public function testHouseCreation()
    {
        $result = factory(House::class)->make();

        $this->assertNotFalse($result);
        $result->delete();
    }

    /**
     * Test to see if Houses can be saved, deleted.
     *
     * @return void
     *
     */

    public function testHouseSaveDelete(){
        $h = factory(House::class)->make();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
