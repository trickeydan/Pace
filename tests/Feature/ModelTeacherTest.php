<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Teacher;

class ModelTeacherTest extends TestCase
{
    /**
     * Test to see if Teachers can be created
     *
     * @return void
     */
    public function testTeacherCreation()
    {
        $result = factory(Teacher::class)->make();

        $this->assertNotFalse($result);
    }

    /**
     * Test to see if Teachers can be saved, deleted.
     *
     * @return void
     *
     */

    public function testTeacherSaveDelete(){
        $p = factory(Teacher::class)->make();
        $this->assertNotFalse($p->save());
        $this->assertNotFalse($p->delete());
    }
}
