<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Account;
use App\Models\User;

class HTTPAdministratorHomeTest extends TestCase
{
    /**
     * This test checks to see if we can visit the admin home page.
     *
     * @return void
     */

    public function testCanVisitAdminHomePage(){
        $user = User::whereAccountableType(Account::ADMINISTRATOR)->first();


        $response = $this->actingAs($user)
            ->get(route('admin.home'));


        $response->assertStatus(200,'Could not visit admin home page');
        $user->delete();
    }
}
