<?php

namespace Tests\Feature\HTTP;

use App\Models\Administrator;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthPagesTest extends TestCase
{
    /**
     * Test to see if the login page is accessible
     *
     * @return void
     */
   /* public function testLoginPage()
    {
        $response = $this->get(route('auth.login'));
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testLogoutLink(){
        $admin = factory(Administrator::class)->create();
        $admin->makeUser('email@email.com','passowrd');
        $response = $this->actingAs($admin->user)->get(route('auth.logout'));
        $admin->user->delete();
        $admin->delete();

        $response->assertStatus(302);
        $response->assertHeader('location',route('auth.login'));

    }*/
}
