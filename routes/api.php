<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\PicRoomController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClassroomScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/buildings', [BuildingController::class, 'index']);
    Route::get('/building-with-classrooms/{id}', [BuildingController::class, 'showBuildingWithClassrooms']);
    Route::get('/classrooms', [ClassroomController::class, 'index']);
    Route::get('/classroom-with-details/{id}', [ClassroomController::class, 'showClassroomWithDetails']);
});

Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {
    Route::apiResource('/pic-rooms', PicRoomController::class);
    Route::apiResource('/semesters', SemesterController::class);
    Route::apiResource('/classroom-schedules', ClassroomScheduleController::class);
    Route::post('/buildings', [BuildingController::class, 'store']);
    Route::get('/buildings/{id}', [BuildingController::class, 'show']);
    Route::put('/buildings/{id}', [BuildingController::class, 'update']);
    Route::delete('/buildings/{id}', [BuildingController::class, 'destroy']);
    Route::post('/classrooms', [ClassroomController::class, 'store']);
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show']);
    Route::put('/classrooms/{id}', [ClassroomController::class, 'update']);
    Route::delete('/classrooms/{id}', [ClassroomController::class, 'destroy']);
    Route::post('/logout/admin', [AuthenticationController::class, 'logoutAdmin']);
});

Route::middleware(['auth:sanctum', 'type.student'])->group(function () {
    Route::post('/logout/student', [AuthenticationController::class, 'logoutStudent']);
});


Route::post('/login/admin', [AuthenticationController::class, 'loginAdmin']);
Route::post('/login/student', [AuthenticationController::class, 'loginStudent']);
