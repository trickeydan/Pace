<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Account;

class HTTPPupilHomeTest extends TestCase
{
    /**
     * This test checks to see if we can visit the pupil home page.
     *
     * @return void
     */

    public function testCanVisitPupilHomePage(){
        $user = User::whereAccountableType(Account::PUPIL)->first();


        $response = $this->actingAs($user)
            ->get(route('pupil.home'));


        $response->assertStatus(200,'Could not visit pupil home page');
    }
}
