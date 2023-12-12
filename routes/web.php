<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\StreamVideoController;
use App\Http\Controllers\VideoController;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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

Route::get('/',  HomeControler::class)->name("home");

Route::get('/pivot', function () {
    $video = Video::find(1);

    $time=$video->users->find(1)->pivot->watched_duration;

    $time_parts = explode(":", $time);
    $seconds = $time_parts[1] + $time_parts[0] * 60;
    


    // dd($video->withPivot->watched_time);
});

Route::get('/get-video/{video_name}', [StreamVideoController::class, 'getVideo'])->name('getVideo');

Route::resource('course', App\Http\Controllers\CourseController::class);

Route::resource('video', App\Http\Controllers\VideoController::class);

Route::resource('progress', App\Http\Controllers\ProgressController::class);
