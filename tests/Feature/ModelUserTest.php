<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Faker\Factory as Faker;

class ModelUserTest extends TestCase
{
    /**
     * Creates a User for testing
     *
     * @return User
     */

    public static function createUser(){
        return factory(User::class)->make();
    }


    /**
     * Test to see if Users can be created
     *
     * @return void
     */
    public function testUserCreation()
    {
        $result = self::createUser();

        $this->assertNotFalse($result);
        $result->delete();
    }

    /**
     * Test to see if Users can be saved, deleted.
     *
     * @return void
     *
     */

    public function testUserSaveDelete(){
        $h = self::createUser();
        $this->assertNotFalse($h->save());
        $this->assertNotFalse($h->delete());
    }
}
