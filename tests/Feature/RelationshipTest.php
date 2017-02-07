<?php

namespace Tests\Feature;

use App\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Faker\Factory as Faker;

class RelationshipTest extends TestCase
{
    /**
     * Test attachment of a Pupil to a user.
     *
     * @return void
     */
    public function testPupilUserPolyMorphic(){
        $user = ModelUserTest::createUser();
        $pupil = ModelPupilTest::createPupil();
        $user->save();
        $pupil->save();
        $res = $user->accountable()->associate($pupil);
        $this->assertNotFalse($res);
        $user->save();
        $this->assertEquals($pupil->id,$user->accountable->id);
        $this->assertEquals($user->accountable->getType(),Account::PUPIL);
        $user->delete();
        $pupil->delete();
    }
}
