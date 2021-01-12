<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Students;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pl_PL');

        for($i=0;$i<25;$i++){
            $student = new Students();
            $student->name = $faker->firstName;
            if(rand('0',1) == 1){
                $student->second_name = $faker->firstName;
            }
            $student->last_name = $faker->lastName;
            $student->date_of_birth = $faker->date();
            $student->sex = $faker->randomElement(['kobieta', 'mężczyzna']);
            $student->classes_id = $faker->numberBetween($min = 1, $max = 4);
            $student->users_id = $i+5;
            $student->save();

        }

    }
}

