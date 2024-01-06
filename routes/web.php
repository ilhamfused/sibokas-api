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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
// Route::get('/students', [App\Http\Controllers\StudentController::class, 'students'])->name('students');
// Route::get('/semester', [App\Http\Controllers\SemesterController::class, 'semester'])->name('semester');
// Route::get('/building', [App\Http\Controllers\BuildingController::class, 'building'])->name('building');
// Route::get('/picroom', [App\Http\Controllers\PicRoomController::class, 'picroom'])->name('picroom');
// Route::get('/classroom', [App\Http\Controllers\ClassroomController::class, 'classroom'])->name('classroom');
// Route::get('/report', [App\Http\Controllers\ClassroomReportController::class, 'report'])->name('report');
// Route::get('/booking', [App\Http\Controllers\BookingController::class, 'booking'])->name('booking');
// Route::get('/schedule', [App\Http\Controllers\ClassroomScheduleController::class, 'schedule'])->name('schedule');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'showAdmin1'])->name('admin');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'showStudents'])->name('students');
Route::get('/semester', [App\Http\Controllers\SemesterController::class, 'showSemester'])->name('semester');
Route::get('/building', [App\Http\Controllers\BuildingController::class, 'showBuilding'])->name('building');
Route::get('/picroom', [App\Http\Controllers\PicRoomController::class, 'showPicroom'])->name('picroom');
Route::get('/classroom', [App\Http\Controllers\ClassroomController::class, 'showClassroom'])->name('classroom');
Route::get('/report', [App\Http\Controllers\ClassroomReportController::class, 'showReport'])->name('report');
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'showBooking'])->name('booking');
Route::get('/schedule', [App\Http\Controllers\ClassroomScheduleController::class, 'showSchedule'])->name('schedule');

Route::get('/tambah-student', function () {
    return view('tambahStudent');
})->name('tambahStudent');

Route::post('/tambahstudent', [App\Http\Controllers\StudentController::class, 'tambahStudent'])->name('tambahstudent');
Route::delete('/deletestudent/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudent'])->name('deletestudent');
Route::get('/students/{id}/edit', [App\Http\Controllers\StudentController::class, 'editStudent'])->name('student.edit');
Route::put('/students/{id}', [App\Http\Controllers\StudentController::class, 'updateStudent'])->name('student.update');

Route::get('/tambah-semester', function () {
    return view('tambahSemester');
})->name('tambahSemester');

Route::post('/tambahsemester', [App\Http\Controllers\SemesterController::class, 'tambahSemester'])->name('tambahsemester');
Route::delete('/deletesemester/{id}', [App\Http\Controllers\SemesterController::class, 'deleteSemester'])->name('deletesemester');
Route::get('/semesters/{id}/edit', [App\Http\Controllers\SemesterController::class, 'editSemester'])->name('semester.edit');
Route::put('/semesters/{id}', [App\Http\Controllers\SemesterController::class, 'updateSemester'])->name('semester.update');

Route::get('/tambah-building', function () {
    return view('tambahBuilding');
})->name('tambahBuilding');

Route::post('/tambahbuilding', [App\Http\Controllers\BuildingController::class, 'tambahBuilding'])->name('tambahbuilding');
Route::delete('/deletebuilding/{id}', [App\Http\Controllers\BuildingController::class, 'deleteBuilding'])->name('deletebuilding');
Route::get('/buildings/{id}/edit', [App\Http\Controllers\BuildingController::class, 'editBuilding'])->name('building.edit');
Route::put('/buildings/{id}', [App\Http\Controllers\BuildingController::class, 'updateBuilding'])->name('building.update');

Route::get('/tambah-picroom', function () {
    return view('tambahPicroom');
})->name('tambahPicroom');

Route::post('/tambahpicroom', [App\Http\Controllers\PicRoomController::class, 'tambahPicroom'])->name('tambahpicroom');
Route::delete('/deletepicroom/{id}', [App\Http\Controllers\PicRoomController::class, 'deletePicroom'])->name('deletepicroom');
Route::get('/picrooms/{id}/edit', [App\Http\Controllers\PicRoomController::class, 'editPicroom'])->name('picroom.edit');
Route::put('/picrooms/{id}', [App\Http\Controllers\PicRoomController::class, 'updatePicroom'])->name('picroom.update');

Auth::routes();
