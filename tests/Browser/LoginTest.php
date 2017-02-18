<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LoginTest extends DuskTestCase
{
    /**
     * Test to see if the page is viewable
     *
     * @return void
     */
    public function testCanView()
    {
        $this->browse(function ($browser) {
            $browser->visit(new Login)
                    ->assertTitleContains('Login')
                    ->assertSee('Log In');
        });
    }

    /**
     * Test to see if an error message is displayed when the email is not in db.
     *
     * @return void
     */

    public function testBadEmail(){


        $this->browse(function ($browser) {

            $browser->visit(new Login())
                ->type('email','NOTANEMAILADDRESS@gmail.com')
                ->type('password','secret')
                ->press('Log In')
                ->assertSee('These credentials do not match our records.');
        });

    }

    /**
     * Test to see if an error message is displayed when the password is incorrect.
     *
     * @return void
     */

    public function testBadPassword(){


        $this->browse(function ($browser) {

            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.

            $browser->visit(new Login())
                ->type('email',$user->email)
                ->type('password','incorrect!')
                ->press('Log In')
                ->assertSee('These credentials do not match our records.');

            $user->delete();
        });

    }

    /**
     * Test to see if the password reset link works.
     *
     * @return void
     */

    public function testPasswordResetLink(){


        $this->browse(function ($browser) {

            $browser->visit(new Login())
                ->assertSeeLink('Forgot your password?')
                ->clickLink('Forgot your password?')
                ->assertSee('Forgot Password');
        });

    }

    /**
     * Test to see if a user can login.
     *
     * @return void
     */

    public function testCanLogin(){


        $this->browse(function ($browser) {

            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.

            $browser->visit(new Login())
                ->type('email',$user->email)
                ->type('password','secret')
                ->press('Log In')
                ->assertPathIs('/')
                ->assertSee('PACE');
            $user->delete();
        });

    }
}
