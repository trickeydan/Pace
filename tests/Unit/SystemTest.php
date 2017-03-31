<?php

namespace Tests\Unit;

use App\System;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SystemTest extends TestCase
{
    /**
     * Test the last updated function
     *
     * @return void
     */
    public function testLastUpdated(){
        //Todo: Make a better test
        $this->assertNotEquals('30/1/80',System::lastUpdated());
        $this->assertNotNull(System::lastUpdated());
    }

    /**
     * Test the getRam function
     *
     * @return void
     */
    public function testGetRam(){
        $this->assertNotNull(System::getRam());
    }

    /**
     * Test the GSPCheck function
     *
     * @return void
     */
    public function testGSPCheck(){
        $this->assertFalse(System::checkGeneralSystemPassword('NOT A PASSWORD'));
    }

}
