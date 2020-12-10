<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassesHasSubjectsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE VIEW classes_has_subjects_view AS SELECT
    classes_has_subjects.id AS classes_has_subjects_id,
    classes.id AS classes_id,
    classes.name AS classes_name,
    teachers.id AS teachers_id,
    teachers.name AS teachers_name,
    teachers.second_name AS teachers_second_name,
    teachers.last_name AS teachers_last_name,
    subjects.id AS subjects_id,
    subjects.name AS subjects_name
FROM
    `classes_has_subjects`,
    `classes`,
    `subjects`,
    `teachers`
WHERE
    classes_has_subjects.classes_id = classes.id AND classes_has_subjects.teachers_id = teachers.id AND classes_has_subjects.subjects_id = subjects.id');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW classes_has_subjects_view');
    }
}
