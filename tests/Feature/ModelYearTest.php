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
     * Creates a Year for testing
     *
     * @return Year
     */

    public static function createYear(){
        $faker = Faker::create();

        return Year::create();
    }


    /**
     * Test to see if Years can be created
     *
     * @return void
     */
    public function testYearCreation()
    {
        $result = self::createYear();

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
        $h = self::createYear();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
