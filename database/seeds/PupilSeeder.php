<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\User;

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
        factory(App\House::class,4)->create()->each(function($house){
            // Create 5 tutorgroups.
            factory(App\Tutorgroup::class, 5)->create(['house_id' => $house->id])->each(function ($tg) {
                // Now make 20 pupils
                factory(App\Pupil::class, 20)->create(['tutorgroup_id' => $tg->id])
                ->each(function($pupil){
                    // Now create a user for each pupil.
                    factory(App\User::class)->create(['accountable_type' => Account::PUPIL,'accountable_id' => $pupil->id]);
                });
            });
        });




        // Now make the testing user.
        $u = User::inRandomOrder()->first();
        $u->email = "pupil@example.com";
        $u->password = bcrypt('password');
        $u->save();
    }
}
