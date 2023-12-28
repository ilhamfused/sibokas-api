<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'students'])->name('students');
Route::get('/semester', [App\Http\Controllers\SemesterController::class, 'semester'])->name('semester');
Route::get('/building', [App\Http\Controllers\BuildingController::class, 'building'])->name('building');
Route::get('/picroom', [App\Http\Controllers\PicRoomController::class, 'picroom'])->name('picroom');

Auth::routes();
