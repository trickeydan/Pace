<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Administrator;

class BaseModelTest extends TestCase
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
     * Test the model identifer
     *
     * @return void
     */
    public function testGetIdentifer(){
        $result = $this->admin->getIdentifier();
        $expected = base64_encode(get_class($this->admin) . ':' . $this->admin->id);
        $this->assertEquals($result,$expected);
    }
}
