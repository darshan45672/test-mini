<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HoDController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserStudentsController;
use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\UserFacultiesController;
use App\Http\Controllers\Api\CollegeStudentsController;
use App\Http\Controllers\Api\StudentActivitiesController;
use App\Http\Controllers\Api\DepartmentStudentsController;
use App\Http\Controllers\Api\DepartmentFacultiesController;
use App\Http\Controllers\Api\ActivityTypeActivitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('activities', ActivityController::class);

        Route::apiResource('colleges', CollegeController::class);

        // College Students
        Route::get('/colleges/{college}/students', [
            CollegeStudentsController::class,
            'index',
        ])->name('colleges.students.index');
        Route::post('/colleges/{college}/students', [
            CollegeStudentsController::class,
            'store',
        ])->name('colleges.students.store');

        Route::apiResource('departments', DepartmentController::class);

        // Department Students
        Route::get('/departments/{department}/students', [
            DepartmentStudentsController::class,
            'index',
        ])->name('departments.students.index');
        Route::post('/departments/{department}/students', [
            DepartmentStudentsController::class,
            'store',
        ])->name('departments.students.store');

        // Department Faculties
        Route::get('/departments/{department}/faculties', [
            DepartmentFacultiesController::class,
            'index',
        ])->name('departments.faculties.index');
        Route::post('/departments/{department}/faculties', [
            DepartmentFacultiesController::class,
            'store',
        ])->name('departments.faculties.store');

        Route::apiResource('faculties', FacultyController::class);

        Route::apiResource('ho-ds', HoDController::class);

        Route::apiResource('students', StudentController::class);

        // Student Activities
        Route::get('/students/{student}/activities', [
            StudentActivitiesController::class,
            'index',
        ])->name('students.activities.index');
        Route::post('/students/{student}/activities', [
            StudentActivitiesController::class,
            'store',
        ])->name('students.activities.store');

        Route::apiResource('users', UserController::class);

        // User Students
        Route::get('/users/{user}/students', [
            UserStudentsController::class,
            'index',
        ])->name('users.students.index');
        Route::post('/users/{user}/students', [
            UserStudentsController::class,
            'store',
        ])->name('users.students.store');

        // User Faculties
        Route::get('/users/{user}/faculties', [
            UserFacultiesController::class,
            'index',
        ])->name('users.faculties.index');
        Route::post('/users/{user}/faculties', [
            UserFacultiesController::class,
            'store',
        ])->name('users.faculties.store');

        Route::apiResource('activity-types', ActivityTypeController::class);

        // ActivityType Activities
        Route::get('/activity-types/{activityType}/activities', [
            ActivityTypeActivitiesController::class,
            'index',
        ])->name('activity-types.activities.index');
        Route::post('/activity-types/{activityType}/activities', [
            ActivityTypeActivitiesController::class,
            'store',
        ])->name('activity-types.activities.store');
    });
