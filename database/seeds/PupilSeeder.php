<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\User;
use App\House;

class PupilSeeder extends Seeder
{
    /**
     * This seeder creates pupil accounts.
     *
     * @return void
     */
    public function run()
    {
        // Firstly, create 4 houses.
        factory(App\House::class,4)->create();

        //Make teachers here.

        factory(App\Teacher::class,50)->create();

        //Make some PupilPointTypes

        factory(App\PupilPointType::class,6)->create();

        // Now create 4 years
        factory(App\Year::class,4)->create()->each(function($year){

            foreach(House::all() as $house){
                // Create 1 tutorgroup(s) in each house.
                factory(App\Tutorgroup::class, 1)->create(['house_id' => $house->id,'year_id' => $year->id])->each(function ($tg) {
                    // Now make 20 pupils
                    factory(App\Pupil::class, 20)->create(['tutorgroup_id' => $tg->id])
                        ->each(function($pupil){
                            // Now create a user for each pupil.
                            factory(App\User::class)->create(['accountable_type' => Account::PUPIL,'accountable_id' => $pupil->id]);

                            //Now give the pupil some points.

                            for($i = 0;$i < random_int(0,100);$i++){
                                $teacher = \App\Teacher::inRandomOrder()->first();
                                $type = \App\PupilPointType::inRandomOrder()->first();
                                factory(App\PupilPoint::class)->create(['pupil_id' => $pupil->id,'teacher_id' => $teacher->id,'pupil_point_type_id' => $type->id]);
                            }
                        });
                });
            }
        });






        // Now make the testing user.
        $u = User::inRandomOrder()->first();
        $u->email = "pupil@example.com";
        $u->password = bcrypt('password');
        $u->save();
    }
}
