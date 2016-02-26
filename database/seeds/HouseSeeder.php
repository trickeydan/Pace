<?php

use Illuminate\Database\Seeder;

use Pace\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::create(['name' => 'Berkeley','colour' => '35b547']);
        House::create(['name' => 'Durand','colour' => '4d92c4']);
        House::create(['name' => 'Logan','colour' => 'eead03']);
        House::create(['name' => 'Wellicome','colour' => 'ff0f07']);

        $user = new Pace\User();
        $user->name = "Initial Admin";
        $user->email = "admininit@example.com";
        $user->emailhash = hash('sha256',$user->email);
        $user->password = bcrypt('password');
        $user->user_level = 3;
        $user->save();
    }
}
