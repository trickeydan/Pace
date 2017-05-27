<?php

namespace Tests\Feature\HTTP;

use App\Models\Administrator;
use App\Models\Pupil;
use App\Notifications\sendPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordPagesTest extends TestCase
{
    /**
     * Test to see if the Password Page is accessible
     *
     * @return void
     */
    public function testFormPage(){
        $response = $this->get(route('auth.password'));
        $response->assertStatus(200);
        $response->assertSee('Forgot Password');
        $response->assertSee('Please enter your email address.');
    }

    /**
     * Test to see if the Notification is sent when a pupil uses the form
     *
     * @return void
     */
    public function testFormSubmitPupil(){
        $pupil = factory(Pupil::class)->create();
        $pupil->makeUser('test@example.com','password');
        Notification::fake();
        $response = $this->post(route('auth.password'),['email' => $pupil->user->email]);
        Notification::assertSentTo($pupil->user,sendPassword::class);

        $pupil->user->delete();
        $pupil->delete();
        $response->assertStatus(302);
        $response->assertHeader('location',url()->previous());
        $response->assertSessionHas('status',trans(Password::RESET_LINK_SENT));
    }

    /**
     * Test to see if the notification is NOT sent when an admin submits the form.
     */
    public function testFormSubmitAdmin(){
        $admin = factory(Administrator::class)->create();
        $admin->makeUser('test@example.com','password');
        Notification::fake();
        $response = $this->post(route('auth.password'),['email' => $admin->user->email]);
        Notification::assertNotSentTo($admin->user,sendPassword::class);

        $admin->user->delete();
        $admin->delete();
    }
}
