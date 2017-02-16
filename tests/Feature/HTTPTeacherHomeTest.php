<?php

namespace Tests\Feature;

use Illuminate\Validation\Rules\Unique;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Account;

class HTTPTeacherHomeTest extends TestCase
{
    /**
     * This test checks to see if we can visit the teacher home page.
     *
     * @return void
     */

    public function testCanVisitTeacherHomePage(){
        $user = User::whereAccountableType(Account::TEACHER)->first();
        $user->accountable->hasSetup = true;
        $user->accountable->save();

        $response = $this->actingAs($user)
            ->get(route('teacher.home'));


        $response->assertStatus(200,'Could not visit teacher home page');
        $user->delete();
    }

    /**
     * This test checks to see if we are redirected to the teacher setup.
     *
     * @return void
     */

    public function testRedirectedToSetup(){
        $user = User::whereAccountableType(Account::TEACHER)->first();
        $user->accountable->hasSetup = false;
        $user->accountable->save();

        $response = $this->actingAs($user)
            ->get(route('teacher.home'));


        $response->assertStatus(302,'Not redirected to setup');
        $response->assertHeader('location',route('teacher.setup'));
    }
}
