<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoDController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivityTypeController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('activities', ActivityController::class);
        Route::resource('colleges', CollegeController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('faculties', FacultyController::class);
        Route::resource('ho-ds', HoDController::class);
        Route::resource('students', StudentController::class);
        Route::resource('users', UserController::class);
        Route::resource('activity-types', ActivityTypeController::class);
    });
