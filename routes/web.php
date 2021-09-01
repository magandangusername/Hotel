<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\PromotionController;
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
//Route::get('/promos/{code}', [PromotionController::class, 'promocode']);



Route::get('/roomtab', [AmenitiesController::class, 'index'])->name('roomtab');
Route::get('/suitestab', [AmenitiesController::class, 'index'])->name('suitestab');
Route::get('/avail', [AmenitiesController::class, 'index'])->name('avail');
Route::get('/modify', [AmenitiesController::class, 'index'])->name('modifyreservation');
