<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MclassController;




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
    return redirect()->action([HomeController::class, 'index']);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/mclasses', [MclassController::class, 'index'])->name('mclasses');
Route::get('/class_form', [MclassController::class, 'create'])->name('class_form');
Route::post('/classsubmit', [MclassController::class, 'store'])->name('classsubmit');
Route::get('/mclasses', [MclassController::class, 'show'])->name('show');


Route::get('/student', [StudentController::class, 'index'])->name('students');
Route::get('/studentform', [StudentController::class, 'create'])->name('studentform');

Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('/student/edit/{id}');
Route::post('/student/update', [StudentController::class, 'update'])->name('/student/update');

Route::post('/st_store', [StudentController::class, 'store'])->name('st_store');

// Route::get('/user.get_data',[UserController::class, 'get_data'])->name('get_data');
Route::resource('users', UsersController::class);

