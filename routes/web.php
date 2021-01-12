<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\EducatorsController;
use App\Http\Controllers\ClassesHasSubjectsController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\ParentsHasStudentsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TeachersHasSubjectController;
use App\Http\Controllers\LessonHoursController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator']
], function() {
        // ROLES
    Route::resource('roles', RolesController::class)->only([
        'index','destroy','create','store'
    ]);

        //USERS

    Route::resource('users', UsersController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::get('search_users', [UsersController::class, 'search_users']);


});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Sekretariat']
], function() {

        //STUDENTS
    Route::resource('students', StudentsController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::get('students_search', [StudentsController::class, 'students_search']);

    Route::get('students/add/{class}', [StudentsController::class, 'add'])->name('students.add');

    Route::post('students/storeadd', [StudentsController::class, 'storeadd'])->name('students.storeadd');

        //TEACHERS

    Route::resource('teachers', TeachersController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::get('search_teacher', [TeachersController::class, 'search_teachers']);

    Route::get('teachers/manage_subjects/{id}', [TeachersController::class, 'manage_subjects'])->name('teachers.manage_subjects');

        //EDUCATORS

    Route::resource('educators',EducatorsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

        //PARENTS

    Route::resource('parents', ParentsController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::get('parents/search', [ParentsController::class, 'search'])->name('parents.search');
    Route::post('parents/child_add', [ParentsController::class, 'child_add'])->name('parents.child_add');
    Route::get('parents/child_manage/{id}' , [ParentsController::class, 'child_manage'])->name('parents.child_manage');

        //CLASSES

    Route::resource('classes', ClassesController::class)->only([
        'index','destroy','create','store','edit','update','show'
    ]);

    Route::get('classes/subject/{class}/create', [ClassesController::class, 'add_subject'])->name('classes.subject.create');

    Route::post('classes/store_add_subject', [ClassesController::class, 'store_add_subject'])->name('classes.store_add_subject');

    Route::get('classes/subjects/{class}', [ClassesController::class, 'subjects'])->name('classes.subjects');

    Route::get('classes/getTeacher/{id}', [ClassesController::class, 'getTeacher'])->name('classes.getTeacher');

        //SUBJECTS

    Route::resource('subjects',SubjectsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

        //SCHEDULES

    Route::resource('schedules', SchedulesController::class)->only([
        'create','store','edit','update','destroy'
    ]);

        //LESSON_HOURS

    Route::resource('lesson_hours', LessonHoursController::class)->only([
        'index','edit','update'
    ]);

        //MESSAGES

    Route::get('messages/show_user_message/{id}', [MessagesController::class, 'show_user_message'])->name('messages.show_user_message');

        //OTHER


    Route::resource('parents_has_students', ParentsHasStudentsController::class)->only([
        'destroy'
    ]);

    Route::resource('classeshassubjects', ClassesHasSubjectsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::resource('teachers_has_subjects', TeachersHasSubjectController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);




});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Wychowawca']
], function() {

    Route::resource('educators',EducatorsController::class)->only([
        'show'
    ]);

});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Nauczyciel']
], function() {

        //TEACHERS

    Route::resource('teachers', TeachersController::class)->only([
        'edit','update','show'
    ]);

        //MARKS

    Route::resource('marks', MarksController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::post('marks/delete_mark', [MarksController::class, 'delete_mark'])->name('marks.delete_mark');

    Route::get('marks/show_class/{id}' , [MarksController::class, 'show_class'])->name('marks.show_class');

    Route::post('marks/multiple_store' , [MarksController::class, 'multiple_store'])->name('marks.multiple_store');
});

        //SCHEDULES

    Route::get('schedule/show_teacher/{id}', [SchedulesController::class, 'show_teacher'])->name('schedules.show_teacher');

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Uczen']
], function() {

    Route::resource('students', StudentsController::class)->only([
        'edit','update','show'
    ]);

});


Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Uczen','Nauczyciel','Wychowawca','Sekretariat','Rodzic']
], function() {

        //MARKS

    Route::resource('marks', MarksController::class)->only([
        'show'
    ]);

        //MESSAGES

    Route::resource('messages', MessagesController::class)->only([
        'index','create','show','update','destroy','store'
    ]);

    Route::get('message/create_mass_message', [MessagesController::class, 'create_mass_message'])->name('messages.create_mass_message');

    Route::post('message/multiple_store' , [MessagesController::class, 'multiple_store'])->name('messages.multiple_store');

    Route::get('search', [MessagesController::class, 'search']);

    Route::get('messages/messages_sent/{id}',[MessagesController::class, 'messages_sent'])->name('messages.messages_sent');

        //SCHEDULES

    Route::resource('schedules', SchedulesController::class)->only([
        'index', 'show'
    ]);

        //NOTES

    Route::resource('notes', NotesController::class)->only([
        'index','show'
    ]);

});



Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Rodzic']
], function() {

    Route::resource('parents', ParentsController::class)->only([
        'show','edit','update'
    ]);
    Route::get('parents/child/{id}', [ParentsController::class, 'child'])->name('parents.child');

});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Nauczyciel','Wychowawca','Sekretariat']
], function() {

    Route::get('search_students', [NotesController::class, 'search']);
});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Nauczyciel','Wychowawca','Sekretariat']
], function() {

    Route::resource('notes', NotesController::class)->only([
        'create','destroy','store'
    ]);

});





