<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class ClassesHasSubjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'classes_id ',
        'subjects_id ',
        'teachers_id '
    ];

    public static function getTeacher($subjectid=0){
        $value = DB::select(DB::raw("SELECT `teachers`.`id`,`teachers`.`name`,`teachers`.`second_name`,`teachers`.`last_name` FROM ((`teachers`
                INNER JOIN `teachers_has_subjects` ON `teachers`.`id` = `teachers_has_subjects`.`teachers_id`)
               INNER JOIN `subjects` ON `teachers_has_subjects`.`subjects_id` = `subjects`.`id`)
               WHERE `subjects`.`id` = $subjectid"));

        return $value;
    }
}
