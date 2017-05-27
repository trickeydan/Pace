<?php

namespace Tests\Unit\Models;

use App\Models\Administrator;
use App\Models\User;
use App\Notifications\sendPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * @var User;
     */
    protected $user;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $account = factory(Administrator::class)->create();
        $this->user->accountable_type = Administrator::class;
        $this->user->accountable_id = $account->id;
        $this->user->save();
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->user->accountable->delete();
        $this->user->delete();
        parent::tearDown();
    }

    /**
     * Test the password notification
     *
     * @return void
     */
    public function testPasswordNotificationSend(){
        Notification::fake();
        $this->user->sendPasswordResetNotification(null);
        Notification::assertSentTo($this->user,sendPassword::class);
    }

    /**
     * Test the getName() function
     *
     * @return void
     */
    public function testGetName(){
        $this->assertEquals($this->user->getName(),$this->user->accountable->name);
    }
}
