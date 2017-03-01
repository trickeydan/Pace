<?php

namespace Tests\Unit\Models;

use App\Models\Administrator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdministratorTest extends TestCase
{

    /**
     * @var Administrator;
     */
    protected $admin;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->admin = factory(Administrator::class)->create();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->admin->delete();
        parent::tearDown();
    }

    /**
     * Test if the Administrator can be turned into a string
     *
     * @return void
     */
    public function testToString(){
        $this->assertEquals((string)$this->admin,$this->admin->name);
    }

    /**
     * Test the getHome function
     *
     * @return void
     */
    public function testGetHome(){
        $this->assertEquals($this->admin->getHome(),route('admin.home'));
    }

    /**
     * Test returning of the getTypeHuman function
     *
     * @return void
     */
    public function testGetTypeHuman(){
        $this->assertEquals($this->admin->getTypeHuman(),'Administrator');
    }

    /**
     * Test if the administrator receives alerts works
     *
     * Todo: Update to check against database when the function is changed.
     *
     * @return void
     */
    public function testReceivesAlerts(){
        $this->assertFalse($this->admin->receivesAlerts());
    }
}
