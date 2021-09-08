<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\RoomSuiteController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\BookController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/promos', [PromotionController::class, 'promo'])->name('promo');
Route::get('/promos/{name}', [PromotionController::class, 'show']);
Route::get('/roomtab', [RoomSuiteController::class, 'rooms'])->name('roomtab');
Route::get('/suitestab', [RoomSuiteController::class, 'suites'])->name('suitestab');
Route::get('/roomtab/{name}', [RoomSuiteController::class, 'roominfo']);
Route::get('/suitestab/{name}', [RoomSuiteController::class, 'suiteinfo']);
Route::resource('/book', BookController::class);
//Route::get('/book', [BookController::class, 'index'])->name('avail');
//Route::get('/promos/{code}', [PromotionController::class, 'promocode']);





Route::get('/modify', [AmenitiesController::class, 'index'])->name('modifyreservation');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
