<?php

namespace Tests\Feature;

use App\Account;
use App\House;
use App\Pupil;
use App\Tutorgroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Faker\Factory as Faker;

class RelationshipTest extends TestCase
{

    //Relationships with Pupils

    /**
     * Test relationship of pupils and tutorgroups.
     *
     * @return void
     */
    public function testPupilTutorgroup(){
        $pupil = factory(Pupil::class)->make();
        $tutorgroup = factory(Tutorgroup::class)->create();
        $res = $tutorgroup->pupils()->save($pupil);
        $this->assertNotFalse($res);
        $this->assertEquals($pupil->id,$tutorgroup->pupils()->first()->id);
        $this->assertGreaterThanOrEqual(1,$tutorgroup->pupils()->count());
        $tutorgroup->delete();
    }

    /**
     * Test attachment of a Pupil to a user.
     *
     * @return void
     */
    public function testPupilUser(){
        $user = factory(User::class)->create();
        $pupil = factory(Pupil::class)->create();
        $res = $user->accountable()->associate($pupil);
        $this->assertNotFalse($res);
        $user->save();
        $this->assertEquals($pupil->id,$user->accountable->id);
        $this->assertEquals($user->accountable->getType(),Account::PUPIL);
        $user->delete();
        $pupil->delete();
    }

    //Relationships with Houses

    public function testHouseTutorgroup(){
        $house = factory(House::class)->create();
        $tutorgroup = factory(Tutorgroup::class)->make();
        $res = $house->tutorgroups()->save($tutorgroup);
        $this->assertNotFalse($res);
        $this->assertEquals($tutorgroup->id,$house->tutorgroups()->first()->id);
        $this->assertGreaterThanOrEqual(1,$house->tutorgroups()->count());
        $tutorgroup->delete();
    }


}
