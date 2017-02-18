<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Account;

class HTTPAdministratorPupilIndexTest extends TestCase
{
    /**
     * This test checks to see if we can visit the admin pupil index page.
     *
     * @return void
     */

    public function testCanVisitPupilIndex(){
        $user = User::whereAccountableType(Account::ADMINISTRATOR)->first();


        $response = $this->actingAs($user)
            ->get(route('admin.home'));


        $response->assertStatus(200,'Could not visit admin pupil index.');
        $user->delete();
    }
}
