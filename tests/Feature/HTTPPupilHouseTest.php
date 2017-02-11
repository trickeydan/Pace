<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class HTTPPupilHouseTest extends TestCase
{
    /**
     * This test checks to see if we can visit the pupil house page.
     *
     * @return void
     */

    public function testCanVisitPupilHousePage(){
        $user = User::all()->first(); //Todo: Ensure that it is a pupil user.

        $response = $this->actingAs($user)
            ->get(route('house'));

        $response->assertStatus(200,'Could not visit pupil house page');
        $user->delete();
    }
}
