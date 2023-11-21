<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\PicRoomController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\AuthenticationController;

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
    Route::get('/buildings/classrooms/{id}', [BuildingController::class, 'showBuildingWithClassrooms']);
});

Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {
    Route::apiResource('/pic-rooms', PicRoomController::class);
    Route::apiResource('/semesters', SemesterController::class);
    Route::get('/buildings/{id}', [BuildingController::class, 'show']);
    Route::post('/buildings', [BuildingController::class, 'store']);
});


Route::post('/login/admin', [AuthenticationController::class, 'loginAdmin']);
Route::post('/logout/admin', [AuthenticationController::class, 'logoutAdmin'])->middleware(['auth:sanctum']);
Route::post('/login/student', [AuthenticationController::class, 'loginStudent']);
Route::post('/logout/student', [AuthenticationController::class, 'logoutStudent'])->middleware(['auth:sanctum']);
