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
Route::get('/newsfeed/create', [NewsfeedController::class, 'create']);
Route::post('/newsfeed/store', [NewsfeedController::class, 'store']);
//Newsfeed update
Route::get('/newsfeed/update/{id}', [NewsfeedController::class, 'edit']);
Route::post('/newsfeed/update/{id}', [NewsfeedController::class, 'update']);

//Newsfeed delete
Route::post('/newsfeed/delete/{id}', [NewsfeedController::class, 'destroy']);

//List of consultations
Route::get('/consultations', [ConsultationController::class, 'index']);
//Consultation create
Route::get('/consultation/create', [ConsultationController::class, 'create']);
Route::post('/consultation/store', [ConsultationController::class, 'store']);
//Consultation update
Route::get('/consultation/update/{id}', [ConsultationController::class, 'edit']);
Route::post('/consultation/update/{id}', [ConsultationController::class, 'update']);

//Consultation delete
Route::post('/consultation/delete/{id}', [ConsultationController::class, 'destroy']);

//List of products
Route::get('/products', [ProductController::class, 'index']);
//Product create
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products/store', [ProductController::class, 'store']);
//Product update
Route::get('/products/update/{id}', [ProductController::class, 'edit']);
Route::post('/products/update/{id}', [ProductController::class, 'update']);

//product delete
Route::post('/products/delete/{id}', [ProductController::class, 'destroy']);

