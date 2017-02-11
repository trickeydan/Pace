<?php

namespace Tests\Feature;

use App\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Pupil;
use App\Account;

class HTTPPupilTutorgroupTest extends TestCase
{
    /**
     * This test checks to see if we can visit the pupil tutorgroup page.
     *
     * @return void
     */

    public function testCanVisitPupilTutorgroupPage(){

        $user = User::all()->first(); //Todo: Ensure that it is a pupil user.

        $response = $this->actingAs($user)
            ->get(route('tutorgroup'));


        $response->assertStatus(200,'Could not visit pupil tutorgroup page');
        $user->delete();
    }
}