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

        for($i=0;$i<100;$i++){
            $student = new Students();
            $student->name = $faker->firstName;
            $student->second_name = $faker->firstName;
            $student->last_name = $faker->lastName;
            $student->date_of_birth = $faker->date();
            $student->sex = $faker->randomElement(['kobieta', 'mężczyzna']);
            $student->classes_id = $faker->numberBetween($min = 1, $max = 8);
            $student->users_id = $i+3;
            $student->save();

        }

    }
}

