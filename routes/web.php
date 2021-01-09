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

    Route::resource('schedules', SchedulesController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::resource('parents', ParentsController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::get('parents/search', [ParentsController::class, 'search'])->name('parents.search');
    Route::post('parents/child_add', [ParentsController::class, 'child_add'])->name('parents.child_add');
    Route::get('parents/child_manage/{id}' , [ParentsController::class, 'child_manage'])->name('parents.child_manage');
    Route::resource('users', UsersController::class)->only([
       'index','create','store','edit','update','destroy'
    ]);

    Route::resource('parents_has_students', ParentsHasStudentsController::class)->only([
        'destroy'
    ]);

    Route::resource('roles', RolesController::class)->only([
        'index','destroy','create','store'
    ]);
    Route::resource('classes', ClassesController::class)->only([
        'index','destroy','create','store','edit','update','show'
    ]);

    Route::get('classes/subject/{class}/create', [ClassesController::class, 'add_subject'])->name('classes.subject.create');

    Route::post('classes/store_add_subject', [ClassesController::class, 'store_add_subject'])->name('classes.store_add_subject');

    Route::get('classes/subjects/{class}', [ClassesController::class, 'subjects'])->name('classes.subjects');

    Route::get('classes/getTeacher/{id}', [ClassesController::class, 'getTeacher'])->name('classes.getTeacher');


    Route::resource('students', StudentsController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::get('students/add/{class}', [StudentsController::class, 'add'])->name('students.add');

    Route::post('students/storeadd', [StudentsController::class, 'storeadd'])->name('students.storeadd');

    Route::resource('teachers', TeachersController::class)->only([
        'index','create','store','destroy'
    ]);

    Route::resource('subjects',SubjectsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::resource('educators',EducatorsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::resource('classeshassubjects', ClassesHasSubjectsController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::get('messages/show_user_message/{id}', [MessagesController::class, 'show_user_message'])->name('messages.show_user_message');



});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Sekretariat']
], function() {



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

    Route::resource('teachers', TeachersController::class)->only([
        'edit','update','show'
    ]);

    Route::resource('marks', MarksController::class)->only([
        'index','create','store','edit','update','destroy'
    ]);

    Route::post('marks/delete_mark', [MarksController::class, 'delete_mark'])->name('marks.delete_mark');

//    Route::get('classes/subjects/{class}', [ClassesController::class, 'subjects'])->name('classes.subjects');
    Route::get('marks/show_class/{id}' , [MarksController::class, 'show_class'])->name('marks.show_class');

    Route::post('marks/multiple_store' , [MarksController::class, 'multiple_store'])->name('marks.multiple_store');
});

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

    Route::resource('schedules', SchedulesController::class)->only([
        'show'
    ]);

    Route::resource('marks', MarksController::class)->only([
        'show'
    ]);

    Route::resource('messages', MessagesController::class)->only([
       'index','create','show','update','destroy','store'
    ]);

//    Route::get('messages/mass_message', [MessagesController::class, 'asd'])->name('messages.mass_message');

    Route::get('message/create_mass_message', [MessagesController::class, 'create_mass_message'])->name('messages.create_mass_message');

    Route::post('message/multiple_store' , [MessagesController::class, 'multiple_store'])->name('messages.multiple_store');

    Route::get('search', [MessagesController::class, 'search']);

    Route::get('messages/messages_sent/{id}',[MessagesController::class, 'messages_sent'])->name('messages.messages_sent');

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

    Route::resource('notes', NotesController::class)->only([
        'index','create','show','update','destroy','store'
    ]);
//    Route::get('search_student', [NotesController::class, 'search_student']);

    Route::get('search_students', [NotesController::class, 'search']);
});





