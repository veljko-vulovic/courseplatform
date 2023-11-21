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



Route::resource('course', App\Http\Controllers\CourseController::class);

Route::resource('video', App\Http\Controllers\VideoController::class);

Route::resource('progress', App\Http\Controllers\ProgressController::class);