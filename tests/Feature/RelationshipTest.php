<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Administrator;
use App\Models\House;
use App\Models\Pupil;
use App\Models\PupilPoint;
use App\Models\PupilPointType;
use App\Models\Teacher;
use App\Models\Tutorgroup;
use App\Models\Year;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
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

    /**
     * Test attachment of a Tutorgroup to a house.
     *
     * @return void
     */
    public function testHouseTutorgroup(){
        $house = factory(House::class)->create();
        $tutorgroup = factory(Tutorgroup::class)->make();
        $res = $house->tutorgroups()->save($tutorgroup);
        $this->assertNotFalse($res);
        $this->assertEquals($tutorgroup->id,$house->tutorgroups()->first()->id);
        $this->assertGreaterThanOrEqual(1,$house->tutorgroups()->count());
        $tutorgroup->delete();
        $house->delete();
    }

    /**
     * Test attachment of a Tutorgroup to a year.
     *
     * @return void
     */
    public function testYearTutorgroup(){
        $year = factory(Year::class)->create();
        $tutorgroup = factory(Tutorgroup::class)->make();
        $res = $year->tutorgroups()->save($tutorgroup);
        $this->assertNotFalse($res);
        $this->assertEquals($tutorgroup->id,$year->tutorgroups()->first()->id);
        $this->assertGreaterThanOrEqual(1,$year->tutorgroups()->count());
        $tutorgroup->delete();
        $year->delete();
    }

    /**
     * Test the relationship between pupils and pupilpoints.
     *
     * @return void
     */
    public function testPupilPupilPoint(){
        $pupil = factory(Pupil::class)->create();
        $point = factory(PupilPoint::class)->make();
        $res = $pupil->points()->save($point);
        $this->assertNotFalse($res);
        $this->assertEquals($point->id,$pupil->points()->first()->id);
        $this->assertGreaterThanOrEqual(1,$pupil->points()->count());
        $point->delete();
        $pupil->delete();
    }

    /**
     * Test the relationship between teachers and pupilpoints
     *
     * @return void
     */

    public function testTeacherPupilPoint(){
        $teacher = factory(Teacher::class)->create();
        $point = factory(PupilPoint::class)->make();
        $res = $teacher->points()->save($point);
        $this->assertNotFalse($res);
        $this->assertEquals($point->id,$teacher->points()->first()->id);
        $this->assertGreaterThanOrEqual(1,$teacher->points()->count());
        $point->delete();
        $teacher->delete();
    }

    /**
     * Test the relationship between PupilPoints and PupilPointTypes
     */
    public function testPupilPointPupilPointType(){
        $type = factory(PupilPointType::class)->create();
        $point = factory(PupilPoint::class)->make();
        $res = $type->points()->save($point);
        $this->assertNotFalse($res);
        $this->assertEquals($point->id,$type->points()->first()->id);
        $this->assertGreaterThanOrEqual(1,$type->points()->count());
        $point->delete();
        $type->delete();
    }

    /**
     * Test attachment of a Teacher to a user.
     *
     * @return void
     */
    public function testTeacherUser(){
        $user = factory(User::class)->create();
        $teacher = factory(Teacher::class)->create();
        $res = $user->accountable()->associate($teacher);
        $this->assertNotFalse($res);
        $user->save();
        $this->assertEquals($teacher->id,$user->accountable->id);
        $this->assertEquals($user->accountable->getType(),Account::TEACHER);
        $user->delete();
        $teacher->delete();
    }

    /**
     * Test attachment of an Administrator to a user.
     *
     * @return void
     */
    public function testAdministratorUser(){
        $user = factory(User::class)->create();
        $admin = factory(Administrator::class)->create();
        $res = $user->accountable()->associate($admin);
        $this->assertNotFalse($res);
        $user->save();
        $this->assertEquals($admin->id,$user->accountable->id);
        $this->assertEquals($user->accountable->getType(),Account::ADMINISTRATOR);
        $user->delete();
        $admin->delete();
    }
}
