<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;


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
Route::get('/user', [UsersController::class, 'index'])->name('user.index');

// Route::get('/user.get_data',[UserController::class, 'get_data'])->name('get_data');
Route::resource('users', UsersController::class);
Route::get('/students_form', [StudentsController::class, 'create'])->name('students_form');
Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
Route::post('/students_data',[StudentsController::class, 'store'])->name('students_data');
Route::get('/st/edit/{id}',[StudentsController::class,'edit'])->name('st/edit/{id}');
Route::post('/students_update',[StudentsController::class,'update'])->name('/students_update');
Route::get('/st/delete/{id}',[StudentsController::class,'destroy'])->name('st/delete/{id}');