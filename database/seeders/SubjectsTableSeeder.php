<?php

namespace Database\Seeders;
use App\Models\Subjects;
use Illuminate\Database\Seeder;
use DB;

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


        $subject = new Subjects();
        $subject->name = 'Matematyka';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Język Polski';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Język Angielski';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Język Niemiecki';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Historia';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Fizyka';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Chemia';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Biologia';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        $subject = new Subjects();
        $subject->name = 'Geografia';
        $subject->description = 'Przedmiot ogólnokształcący';
        $subject->save();

        DB::table('teachers_has_subjects')->insert([
            'teachers_id' => '1',
            'subjects_id' => '1',
        ]);
    }
}
