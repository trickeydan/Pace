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

    public function testCanVisitPupilHomePage(){
        $user = User::whereAccountableType(Account::TEACHER)->first();


        $response = $this->actingAs($user)
            ->get(route('teacher.home'));


        $response->assertStatus(200,'Could not visit teacher home page');
        $user->delete();
    }
}
