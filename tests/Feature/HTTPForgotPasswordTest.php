<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HTTPForgotPasswordTest extends TestCase
{
    /**
     * This test checks to see if we can visit the forgot password page.
     *
     * @return void
     */

    public function testCanVisitForgotPasswordPage(){
        $response = $this->get(route('auth.password'));
        $response->assertStatus(200,'Could not visit forgot password page');
    }
}
