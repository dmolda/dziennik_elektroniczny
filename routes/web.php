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



    Route::resource('users', UsersController::class)->only([
       'index','create','store','edit','update','destroy'
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
    'roles' => ['Administrator','Uczen','Nauczyciel','Wychowawca','Sekretariat']
], function() {

    Route::resource('schedules', SchedulesController::class)->only([
        'show'
    ]);

});







