<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;
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
    return view('google_calendar');
});

Route::get('/google-calendar/connect', [GoogleCalendarController::class,'connect']);
Route::get('/auth', [GoogleCalendarController::class,'store']);
Route::get('get-resource', [GoogleCalendarController::class,'getResources']);