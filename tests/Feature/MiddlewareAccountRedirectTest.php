<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Account;

class MiddlewareAccountRedirectTest extends TestCase
{
    /**
     * Test if a pupil is redirected when attempting to access a teacher resource
     *
     * @return void
     */
    public function testRedirect(){
        $user = User::whereAccountableType(Account::PUPIL)->first();
        $response = $this->actingAs($user)
            ->get(route('teacher.home'));

        $response->assertStatus(302,'No redirect when pupil accesses teacher resource'); //302 due to redirect.
        $response->assertHeader('location',route('pupil.home')); //
    }
}
