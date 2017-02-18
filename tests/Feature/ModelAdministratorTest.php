<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Administrator;

class ModelAdministratorTest extends TestCase
{
    /**
     * Test to see if Administrators can be created
     *
     * @return void
     */
    public function testAdministratorCreation()
    {
        $result = factory(Administrator::class)->make();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if Administrators can be saved, deleted.
     *
     * @return void
     *
     */

    public function testAdministratorSaveDelete(){
        $p = factory(Administrator::class)->make();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
