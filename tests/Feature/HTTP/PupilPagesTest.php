<?php

namespace Tests\Feature\HTTP;

use App\Models\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Pupil;

class PupilPagesTest extends TestCase
{
    /**
     * @var Pupil;
     */
    protected $pupil;

    /**
     * Set up for the tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->pupil = factory(Pupil::class)->create(['tutorgroup_id' => Tutorgroup::first()->id]);
        $this->pupil->makeUser('test@example.com','password');
    }

    /**
     * Remove data that the test used
     *
     * @return void
     */
    public function tearDown()
    {
        $this->pupil->user->delete();
        $this->pupil->delete();
        parent::tearDown();
    }

    /**
     * Test if the pupil can view their home
     *
     * @return void
     */
    public function testHome(){
        $response = $this->actingAs($this->pupil->user)->get(route('pupil.home'));
        $response->assertStatus(200);
        $response->assertSee($this->pupil->getName());
    }

    /**
     * Test if the pupil can view their tutorgroup
     *
     * @return void
     */
    public function testTutorgroup(){
        $response = $this->actingAs($this->pupil->user)->get(route('pupil.tutorgroup'));
        $response->assertStatus(200);
        $response->assertSee($this->pupil->getName());
        $response->assertSee($this->pupil->tutorgroup->name);
    }

    /**
     * Test if the pupil can view their house
     *
     * @return void
     */
    public function testHouse(){
        $response = $this->actingAs($this->pupil->user)->get(route('pupil.house'));
        $response->assertStatus(200);
        $response->assertSee($this->pupil->getName());
        $response->assertSee($this->pupil->tutorgroup->house->name);
    }
}
