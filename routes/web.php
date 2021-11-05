<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\RoomSuiteController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChooseRoomController;
use App\Http\Controllers\BookInformationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ModifyReservationController;
use App\Http\Controllers\SearchModifyController;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;
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


Route::get('profile', function () {
    // Only verified users may enter...

})->middleware('verified');


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/userprofile', [ProfileController::class, 'userprofile'])->name('userprofile');
Route::get('/promos', [PromotionController::class, 'promo'])->name('promo');
Route::get('/promos/{name}', [PromotionController::class, 'show']);
Route::get('/roomtab', [RoomSuiteController::class, 'rooms'])->name('roomtab');
Route::get('/suitestab', [RoomSuiteController::class, 'suites'])->name('suitestab');
Route::get('/roomtab/{name}', [RoomSuiteController::class, 'roominfo']);
Route::get('/suitestab/{name}', [RoomSuiteController::class, 'suiteinfo']);

Route::resource('/book', BookController::class);
Route::resource('/chooseroom', ChooseRoomController::class);
Route::resource('/bookinfo', BookInformationController::class);
Route::resource('/search', SearchModifyController::class);

Route::get('stripe', [StripeController::class, 'stripe'])->middleware('verified');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post')->middleware('verified');

//Route::get('/book', [BookController::class, 'index'])->name('avail');
//Route::get('/promos/{code}', [PromotionController::class, 'promocode']);

Auth::routes(['verify' => true]);

// Route::view('/complete', 'confdisplay');

// Route::get('/modify', [ModifyReservationController::class, 'index'])->name('modifyreservation');
Route::resource('/modify', ModifyReservationController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    echo 'email sent!';
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
