<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pl_PL');

        $classes = new Classes();
        $classes->name = "1a";
        $classes->description = 'Ogólnokształcący';
        $classes->save();

        $classes = new Classes();
        $classes->name = "1b";
        $classes->description = 'Ogólnokształcący';
        $classes->save();

        $classes = new Classes();
        $classes->name = "2a";
        $classes->description = 'Ogólnokształcący';
        $classes->save();

        $classes = new Classes();
        $classes->name = "3a";
        $classes->description = 'Ogólnokształcący';
        $classes->save();



    }
}
