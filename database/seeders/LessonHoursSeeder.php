<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonHours;

class LessonHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson_hours = new LessonHours();
        $lesson_hours->time = '1';
        $lesson_hours->start_time = '8:00';
        $lesson_hours->end_time = '8:45';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '2';
        $lesson_hours->start_time = '8:50';
        $lesson_hours->end_time = '9:35';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '3';
        $lesson_hours->start_time = '9:40';
        $lesson_hours->end_time = '10:25';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '4';
        $lesson_hours->start_time = '10:40';
        $lesson_hours->end_time = '11:25';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '5';
        $lesson_hours->start_time = '11:30';
        $lesson_hours->end_time = '12:15';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '6';
        $lesson_hours->start_time = '12:20';
        $lesson_hours->end_time = '13:05';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '7';
        $lesson_hours->start_time = '13:10';
        $lesson_hours->end_time = '13:55';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '8';
        $lesson_hours->start_time = '14:00';
        $lesson_hours->end_time = '14:45';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '9';
        $lesson_hours->start_time = '14:50';
        $lesson_hours->end_time = '15:35';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '10';
        $lesson_hours->start_time = '15:40';
        $lesson_hours->end_time = '16:25';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '11';
        $lesson_hours->start_time = '16:30';
        $lesson_hours->end_time = '17:15';
        $lesson_hours->save();

        $lesson_hours = new LessonHours();
        $lesson_hours->time = '12';
        $lesson_hours->start_time = '17:20';
        $lesson_hours->end_time = '18:05';
        $lesson_hours->save();

    }
}
