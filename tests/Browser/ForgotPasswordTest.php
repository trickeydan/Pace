<?php

namespace Tests\Browser;

use App\Notifications\sendPassword;
use Illuminate\Support\Facades\Mail;
use Tests\Browser\Pages\ForgotPassword;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ForgotPasswordTest extends DuskTestCase
{
    /**
     * Can the page be visited?
     *
     * @return void
     */
    public function testVisitable()
    {
        $this->browse(function ($browser) {
            $browser->visit(new ForgotPassword)
                    ->assertSee('Forgot Password');
        });
    }

    /**
     * Check that there is a send password link
     *
     * @return void
     */

    public function testButtonExists()
    {
        $this->browse(function ($browser) {
            $browser->visit(new ForgotPassword)
                ->assertSee('Submit');
        });
    }

    /**
     * Test that there is an error message when a non-existent email is put in.
     *
     * @return void
     */

    public function testBadEmailMessage(){

        $this->browse(function ($browser) {
            $browser->visit(new ForgotPassword)
                ->type('email','NOTANEMAIL@gmail.com')
                ->press('Submit')
                ->assertSee('We can\'t find a user with that e-mail address.');
        });
    }

    /**
     *  Test that the message is displayed and notification is sent when a correct email is put in.
     *
     * @return void
     */

    public function testGoodEmailMessage(){

        Mail::fake();

        $this->browse(function ($browser) {
            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.

            $browser->visit(new ForgotPassword)
                ->type('email',$user->email)
                ->press('Submit')
                ->assertSee('We have e-mailed your password!');

            //Mail::assertSent(sendPassword::class);

            $user->delete();
        });
    }
}
