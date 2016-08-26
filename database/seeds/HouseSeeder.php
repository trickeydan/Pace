<?php

use Illuminate\Database\Seeder;

use Pace\House;
use Pace\UserType;

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

        UserType::create(['id' => 1,'name' => 'Pupil']);
        UserType::create(['id' => 2,'name' => 'Teacher']);
        UserType::create(['id' => 3,'name' => 'Administrator']);


        $user = new Pace\User();
        $user->name = "Initial Admin";
        $user->email = "admininit@example.com";
        $user->password = bcrypt('password');
        $user->type_id = UserType::adminID();
        $user->save();
    }
}
