<?php

use Illuminate\Database\Seeder;

class PupilSeeder extends Seeder
{
    /**
     * This seeder creates pupil accounts.
     *
     * @return void
     */
    public function run()
    {
        // Firstly, create 50 pupil accounts.
        factory(App\User::class, 50)->create()->each(function ($u) {
            $u->accountable()->associate(factory(App\Pupil::class)->create());
            $u->save();
        });

        // Now create a pupil account with a known login.
        factory(App\User::class)->create([
            'email' => 'pupil@example.com',
            'password' => bcrypt('password'),
        ])->each(function ($u) {
            $u->accountable()->associate(factory(App\Pupil::class)->create());
            $u->save();
        });
    }
}
