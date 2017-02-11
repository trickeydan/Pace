<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HTTPLoginTest extends TestCase
{
    /**
     * This test checks to see if we can visit the login page.
     *
     * @return void
     */

    public function testCanVisitLoginPage(){
        $response = $this->get(route('auth.login'));
        $response->assertStatus(200,'Could not visit login page');
    }
}
