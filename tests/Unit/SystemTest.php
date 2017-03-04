<?php

namespace Tests\Unit;

use App\System;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SystemTest extends TestCase
{
    /**
     * Test the info logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testInfo(){
        $this->assertTrue(System::info());
    }

    /**
     * Test the warn logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testWarn(){
        $this->assertTrue(System::warn());
    }

    /**
     * Test the fatal logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testFatal(){
        $this->assertTrue(System::fatal());
    }

    /**
     * Test the upload logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testUpload(){
        $this->assertTrue(System::upload());
    }

    /**
     * Test the security logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testSecurity(){
        $this->assertTrue(System::security());
    }

    /**
     * Test the success logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testSuccess(){
        $this->assertTrue(System::success());
    }

    /**
     * Test the report logger
     *
     * Todo: Update with proper logging
     *
     * @return void
     */
    public function testReport(){
        $this->assertTrue(System::report());
    }

    /**
     * Test the last updated function
     *
     * @return void
     */
    public function testLastUpdated(){
        //Todo: Update this when function is done
        $this->assertEquals('30/1/80',System::lastUpdated());
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
