<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SubjectsController;
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

    Route::resource('users', UsersController::class)->only([
       'index','create','store','edit','update','destroy'
    ]);
    Route::resource('roles', RolesController::class)->only([
        'index','destroy','create','store'
    ]);
    Route::resource('classes', ClassesController::class)->only([
        'index','destroy','create','store','edit','update','show'
    ]);

    Route::resource('students', StudentsController::class)->only([
        'index','store','edit','destroy','show','update','create'
    ]);

    Route::get('students/add/{class}', [StudentsController::class, 'add'])->name('students.add');

    Route::post('students/storeadd', [StudentsController::class, 'storeadd'])->name('students.storeadd');

    Route::resource('teachers', TeachersController::class)->only([
        'index','create','store','edit','update','destroy','show'
    ]);

    Route::resource('subjects',SubjectsController::class)->only([
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



});

Route::group([
    'middleware' => 'roles',
    'roles' => ['Administrator','Uczen']
], function() {



});







