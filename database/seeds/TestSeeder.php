<?php

use Illuminate\Database\Seeder;
use Pace\House;
use Pace\PointType;
use Pace\Year;
use Pace\Tutorgroup;
use Pace\User;
use Pace\Point;
use Pace\Teacher;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Pace\Teacher::class,80)->create();

        PointType::create(['name' => 'Effort']);
        PointType::create(['name' => 'Contribution']);
        PointType::create(['name' => 'Attainment/Achievement']);

        $user = new Pace\User();
        $user->name = "Dan Trickey";
        $user->email = "dan@dan.com";
        $user->password = bcrypt('password');
        $user->user_level = 3;
        $user->save();

        for ($i = 7; $i <= 11; $i++) {
            echo $i . PHP_EOL;
            $year = new Year();
            $year->name = $i;
            $year->save();
            for ($j = 1; $j <= 8; $j++) {
                $tg = new Tutorgroup();
                $string = "";
                for ($letter = 1; $letter <= 3; $letter++) {
                    $faker = Faker\Factory::create();
                    $string = $string . $faker->randomLetter();
                }
                $tg->name = $i . strtoupper($string);
                $tg->year_id = $year->id;
                $tg->save();
                for ($k = 1; $k <= 30; $k++) {
                    $user = new User();
                    $faker = Faker\Factory::create();
                    $fn = $faker->firstName();
                    $ln = $faker->lastName();
                    $user->name = $fn . ' ' . $ln;
                    $user->email = (22 - $i) . substr($fn,0,1) .  $ln . '@klbschool.org.uk';
                    $user->adno = $faker->numberBetween(1000,9999);
                    $user->password = bcrypt($user->adno);
                    $user->tutorgroup_id = $tg->id;
                    $user->user_level = 1;
                    $user->currPoints = 0;
                    $user->house_id = House::all()->random(1)->id;
                    if(User::whereEmail($user->email)->count()<=0){
                        $user->save();
                        for ($l = 1; $l <= random_int(0,12); $l++) {
                            $point = new Point();
                            $point->user_id = $user->id;
                            $point->teacher_id = Teacher::all()->random(1)->id;
                            $point->pointtype_id = PointType::all()->random(1)->id;
                            $faker = Faker\Factory::create();
                            $point->date = $faker->date('Y-m-d');
                            $point->description = 'Description of Point/Reason';
                            $point->amount = $faker->numberBetween(1,10);;
                            $point->save();
                        }
                    }
                }
            }
        }

        \Pace\ImportManager::cache();

    }
}
