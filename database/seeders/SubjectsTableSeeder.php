<?php

namespace Database\Seeders;
use App\Models\Subjects;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pl_PL');

        for ($i = 0; $i < 10; $i++) {
            $subject = new Subjects();
            $subject->name = $faker->domainName;
            $subject->description = $faker->realText(100);
            $subject->save();
        }
    }
}
