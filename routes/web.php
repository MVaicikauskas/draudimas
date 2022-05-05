<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\HomeController;
use App\Models\Consultation;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();
//Main window of newsfeeds
Route::get('/home', [NewsfeedController::class, 'index'])->name('newsfeed');
//Newsfeed create
Route::get('/create.new', [NewsfeedController::class, 'create']);
Route::post('/store.new', [NewsfeedController::class, 'store']);
//Newsfeed update
Route::get('/update.new/{id}', [NewsfeedController::class, 'edit']);
Route::post('/update.new/{id}', [NewsfeedController::class, 'update']);

//Newsfeed delete
Route::post('/delete.new/{id}', [NewsfeedController::class, 'destroy']);

//List of consultations
Route::get('/consultations', [ConsultationController::class, 'index']);
//Consultation create
Route::get('/create.consultation', [ConsultationController::class, 'create']);
Route::post('/store.consultation', [ConsultationController::class, 'store']);
//Consultation update
Route::get('/update.consultation/{id}', [ConsultationController::class, 'edit']);
Route::post('/update.consultation/{id}', [ConsultationController::class, 'update']);

//Consultation delete
Route::post('/delete.consultation/{id}', [ConsultationController::class, 'destroy']);



