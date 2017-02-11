<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class MiscellaneousTest extends TestCase
{
    /**
     *  This test checks if the user is redirected when visiting the home page without being logged in.
     *
     * @return void
     */
    public function testHomePageRedirect()
    {

        // Now check if we can visit the home page.

        $response = $this->get('/');
        $this->assertNotFalse($response->isRedirection(),'User not redirected to login page if not logged in.');
        $response->assertStatus(302,'Bad status code on redirect.');

    }

}
