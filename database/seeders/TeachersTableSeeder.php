<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teachers;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pl_PL');

        for($i=0;$i<15;$i++){
            $teacher = new Teachers();
            $teacher->name = $faker->firstName;
            if(rand('0',1) == 1){
                $teacher->second_name = $faker->firstName;
            }
            $teacher->last_name = $faker->lastName;
            $teacher->date_of_birth = $faker->date();
            $teacher->sex = $faker->randomElement(['kobieta', 'mężczyzna']);
            $teacher->users_id = $i+30;
            $teacher->save();

        }
    }
}
