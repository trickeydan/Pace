<?php

namespace Tests\Browser;

use Tests\Browser\Pages\Home;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class HomeTest extends DuskTestCase
{

    /**
     * Can the page be visited?
     *
     * @return void
     */
    public function testVisitable()
    {
        $this->browse(function ($browser) {
            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.
            $browser->loginAs($user)
                ->visit(new Home)
                ->assertSee('PACE');
            $user->delete();
        });
    }

    /**
     * Check the page title is as expected.
     *
     * @return void
     */
    public function testTitle()
    {
        $this->browse(function ($browser) {
            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.
            $browser->loginAs($user)
                ->visit(new Home)
                ->assertTitleContains($user->getName())
                ->assertTitleContains(config('app.name'));
            $user->delete();
        });
    }

    /**
     * Check the navigation contains the site title.
     *
     * @return void
     */
    public function testNavigationTitle()
    {
        $this->browse(function ($browser) {
            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.
            $browser->loginAs($user)
                ->visit(new Home)
                ->assertSee(config('app.name'));
            $user->delete();
        });
    }

    /**
     * Check site title links to home
     *
     * @return void
     */
    /*public function testNameLink()
    {
        $this->browse(function ($browser) {
            $user = factory(User::class)->make(); // Create a user for this test.
            $user->save(); // Save the user in the database.
            $browser->loginAs($user)
                ->visit(new Home)
                ->clickLink()
            $user->delete();
        });
    }*/

    /*
     * Todo: Check name link goes to /
     * Todo: Check name link contains name
     * Todo: Check correct year
     * Todo: Check D.Trickey seen
     * Todo: Check Logout
     */
}
