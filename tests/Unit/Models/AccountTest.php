<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Administrator;

class AccountTest extends TestCase
{
    /**
     * The current working model.
     * @var Administrator
     */
    protected $admin;

    public function setUp()
    {
        parent::setUp();
        $this->admin = factory(Administrator::class)->create();
    }

    public function tearDown()
    {
        parent::tearDown();
        //$this->admin->delete();
    }

    /**
     * Test the user relationship
     *
     * @return void
     */
    public function testUser(){
        //Add a user
        $faker = Factory::create();
        $setuser = $this->admin->makeUser($faker->safeEmail,'password',false);
        $reluser = $this->admin->user()->first();
        $this->assertEquals($setuser->id,$reluser->id);
        $this->assertEquals($setuser->getIdentifier(),$reluser->getIdentifier());
        $setuser->delete();

    }

    /**
     * Test the function that gets the class type
     *
     * @return void
     */
    public function testGetType(){
        $this->assertEquals($this->admin->getType(),Administrator::class);
    }

    /**
     * Test the getName function
     *
     * @return void
     */
    public function testGetName(){
        $this->assertEquals($this->admin->getName(),$this->admin->name);
    }

    /**
     * Test the isSetup function
     *
     * @return void
     */
    public function testIsSetup(){
        $this->assertEquals($this->admin->isSetup(),true);
    }

    /**
     * Test the setup url.
     *
     * @return void
     */
    public function testGetSetupUrl(){
        $this->assertEquals($this->admin->getSetupUrl(),$this->admin->getHome());
    }

    /**
     * Test that a string is returned from testGetPasswordEmail
     *
     * @return void
     */
    public function testGetPasswordEmail(){
        $res = $this->admin->getPasswordToEmail();
        $this->assertNotNull($res);
        $this->assertNotEmpty($res);
    }

    /**
     * Test if a user is created and saved.
     *
     * @return void
     */

    public function testMakeUserSave(){
        $faker = Factory::create();
        $user = $this->admin->makeUser($faker->safeEmail,'password',false);
        $this->assertNotNull($user);
        $this->assertNotFalse($user);
        $this->assertEquals(get_class($user),User::class);
        $user->delete();
    }
}
