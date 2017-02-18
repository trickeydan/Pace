<?php

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;
use App\Models\House;

class PupilSeeder extends Seeder
{
    /**
     * This seeder creates test data
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Configuration::setup(true);

        // Firstly, create 4 houses.
        factory(App\Models\House::class,4)->create();

        //Make a couple of admins

        factory(App\Models\Administrator::class,5)->create()->each(function($admin){
            factory(App\Models\User::class)->create(['accountable_type' => Account::ADMINISTRATOR,'accountable_id' => $admin->id]);
        });

        //Make teachers here.

        factory(App\Models\Teacher::class,50)->create()->each(function($teacher){
            factory(App\Models\User::class)->create(['accountable_type' => Account::TEACHER,'accountable_id' => $teacher->id]);
        });

        //Make some PupilPointTypes

        factory(App\Models\PupilPointType::class,6)->create();

        // Now create 4 years
        factory(App\Models\Year::class,4)->create()->each(function($year){

            foreach(House::all() as $house){
                // Create 1 tutorgroup(s) in each house.
                factory(App\Models\Tutorgroup::class, 1)->create(['house_id' => $house->id,'year_id' => $year->id])->each(function ($tg) {
                    // Now make 20 pupils
                    factory(App\Models\Pupil::class, 20)->create(['tutorgroup_id' => $tg->id])
                        ->each(function($pupil){
                            // Now create a user for each pupil.
                            factory(App\Models\User::class)->create(['accountable_type' => Account::PUPIL,'accountable_id' => $pupil->id]);

                            //Now give the pupil some points.

                            for($i = 0;$i < random_int(0,100);$i++){
                                $teacher = \App\Models\Teacher::inRandomOrder()->first();
                                $type = \App\Models\PupilPointType::inRandomOrder()->first();
                                factory(App\Models\PupilPoint::class)->create(['pupil_id' => $pupil->id,'teacher_id' => $teacher->id,'pupil_point_type_id' => $type->id]);
                            }
                        });
                });
            }
        });


        // Now make the testing users.
        $u = User::whereAccountableType(Account::PUPIL)->inRandomOrder()->first();
        $u->email = "pupil@example.com";
        $u->password = bcrypt('password');
        $u->save();

        $u = User::whereAccountableType(Account::TEACHER)->inRandomOrder()->first();
        $u->email = "teacher@example.com";
        $u->password = bcrypt('password');
        $u->save();

        $u = User::whereAccountableType(Account::ADMINISTRATOR)->inRandomOrder()->first();
        $u->email = "admin@example.com";
        $u->password = bcrypt('password');
        $u->save();
    }
}
