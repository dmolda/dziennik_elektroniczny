<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ClassesController;
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
//    Route::resource('users',UsersController::class);

//    Route::get('users',[UsersController::class,'index'])->name('users');

//    Route::get('users/create',[UsersController::class,'create']);
//
//    Route::post('users/store',[UsersController::class,'store']);

    Route::resource('users', UsersController::class)->only([
       'index','create','store','edit','update','destroy'
    ]);
    Route::resource('roles', RolesController::class)->only([
        'index','destroy','create','store'
    ]);
    Route::resource('classes', ClassesController::class)->only([
        'index','destroy','create','store','edit','update','show'
    ]);

});




