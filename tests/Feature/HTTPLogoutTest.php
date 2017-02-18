<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HTTPLogoutTest extends TestCase
{
    /**
     * This test checks to see if we can visit the logout page.
     *
     * @return void
     */

    public function testCanVisitLogoutPage(){
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('auth.logout'));

        $response->assertStatus(302,'No redirect on logout'); //302 due to logout redirect.
        $response->assertHeader('location',route('auth.login')); //
        $user->delete();
    }
}
