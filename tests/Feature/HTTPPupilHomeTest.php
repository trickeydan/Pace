<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class HTTPPupilHomeTest extends TestCase
{
    /**
     * This test checks to see if we can visit the pupil home page.
     *
     * @return void
     */

    public function testCanVisitPupilHomePage(){
        $user = User::all()->first(); //Todo: Ensure that it is a pupil user.

        $response = $this->actingAs($user)
            ->get(route('home'));

        $response->assertStatus(200,'Could not visit pupil home page');
        $user->delete();
    }
}
