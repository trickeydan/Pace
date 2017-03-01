<?php

namespace Tests\Unit\Models;

use App\Models\Configuration;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfigurationTest extends TestCase
{
    public function testSetupFalse(){
        Configuration::setup(false);
        $this->assertEquals(Configuration::get('isSetup'),'false');
        $res = Hash::check('password',Configuration::get('general_password'));
        $this->assertTrue($res);
    }
    public function testSetupTrue(){
        Configuration::setup(true);
        $this->assertEquals(Configuration::get('isSetup'),'true');
        $res = Hash::check('password',Configuration::get('general_password'));
        $this->assertTrue($res);
    }
}
