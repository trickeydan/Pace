<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MiddlewareHasAccountTest extends TestCase
{
    /**
     * Test for error when a user with no account accesses the system
     *
     * @return void
     */
    public function testCheck(){
        $user = factory(User::class)->create(); // Create a user with no account.
        $response = $this->actingAs($user)
            ->get(route('pupil.home'));

        $response->assertStatus(500,'No error thrown.'); //500 due to abort.

        $user->delete();
    }
}
