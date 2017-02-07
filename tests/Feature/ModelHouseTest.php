<?php

namespace Tests\Feature;

use App\House;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class ModelHouseTest extends TestCase
{
    /**
     * Creates a House for testing
     *
     * @return House
     */

    public static function createHouse(){
        $faker = Faker::create();

        return House::create();
    }


    /**
     * Test to see if Houses can be created
     *
     * @return void
     */
    public function testHouseCreation()
    {
        $result = self::createHouse();

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
        $h = self::createHouse();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
