<?php


use App\Http\Controllers\AdminAccController;
use App\Http\Controllers\AdminGuestAccController;
use App\Http\Controllers\AdminLogController;
use App\Http\Controllers\AdminPaymentInfoController;
use App\Http\Controllers\AdminGuestInfoController;
use App\Http\Controllers\AdminCancellationsController;
use App\Http\Controllers\AdminReservationsController;
use App\Http\Controllers\AdminModificationsController;
use App\Http\Controllers\AdminRoomAddController;
use App\Http\Controllers\AdminSuiteAddController;
use App\Http\Controllers\AdminRateAddController;
use App\Http\Controllers\AdminPromotionAddController;
use App\Http\Controllers\AdminAmenityAddController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\ReservationPoliciesController;
use App\Http\Controllers\AboutusController;


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
use App\Http\Controllers\DashboardController;

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


Route::middleware('can:accessAdmin')->group(function () {
    // future adminpanel routes also should belong to the group



    Route::get('/admin', [DashboardController::class, 'DashboardController'])->name('dashboard');

    Route::get('/admin/reservation', [AdminReservationsController::class, 'index'])->name('adminreservation');
    Route::post('/admin/reservation', [AdminReservationsController::class, 'editreservation'])->name('admineditreservation');

    Route::get('/admin/cancellation', [AdminCancellationsController::class, 'index'])->name('admincancellation');
    Route::post('/admin/cancellation', [AdminCancellationsController::class, 'approvedeny'])->name('admineditcancellation');

    Route::get('/admin/modification', [AdminModificationsController::class, 'index'])->name('adminmodification');

    Route::get('/admin/addroom', [AdminRoomAddController::class, 'index'])->name('adminroom');
    Route::post('/admin/addroom', [AdminRoomAddController::class, 'modifyrooms'])->name('admineditroom');

    Route::get('/admin/addsuite', [AdminSuiteAddController::class, 'index'])->name('adminsuite');
    Route::post('/admin/addsuite', [AdminSuiteAddController::class, 'modifysuites'])->name('admineditsuite');

    Route::get('/admin/addamenity', [AdminAmenityAddController::class, 'index'])->name('adminamenity');
    Route::post('/admin/addamenity', [AdminAmenityAddController::class, 'modifyamenity'])->name('admineditamenity');

    Route::get('/admin/addrate', [AdminRateAddController::class, 'index'])->name('adminrate');
    Route::post('/admin/addrate', [AdminRateAddController::class, 'modifyrates'])->name('admineditrate');

    Route::get('/admin/addpromotion', [AdminPromotionAddController::class, 'index'])->name('adminpromotion');
    Route::post('/admin/addpromotion', [AdminPromotionAddController::class, 'modifypromotion'])->name('admineditpromotion');

    Route::get('/admin/guestinfo', [AdminGuestInfoController::class, 'index'])->name('adminguestinfo');
    Route::post('/admin/guestinfo', [AdminGuestInfoController::class, 'modifyguestinfo'])->name('admineditguestinfo');

    Route::get('/admin/paymentinfo', [AdminPaymentInfoController::class, 'index'])->name('adminguestpayment');
    Route::get('/admin/log', [AdminLogController::class, 'index'])->name('adminlog');

    Route::get('/admin/guestacc', [AdminGuestAccController::class, 'index'])->name('adminguestacc');
    Route::post('/admin/guestacc', [AdminGuestAccController::class, 'modifyguestacc'])->name('admineditguestacc');


    Route::get('/admin/acc', [AdminAccController::class, 'index'])->name('adminacc');
    Route::post('/admin/acc', [AdminAccController::class, 'modifyadminacc'])->name('admineditacc');

    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('adminlogin');
    Route::get('/admin/register', [AdminRegisterController::class, 'index'])->name('adminregister');
    Route::get('/admin/resetpass', [AdminResetPasswordController::class, 'index'])->name('adminresetpass');
});


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/userprofile', [ProfileController::class, 'userprofile'])->name('userprofile');
Route::post('/userprofile', [ProfileController::class, 'updateprofile'])->name('updateprofile');
Route::get('/promos', [PromotionController::class, 'promo'])->name('promo');
Route::get('/promos/{name}', [PromotionController::class, 'show']);
Route::get('/roomtab', [RoomSuiteController::class, 'rooms'])->name('roomtab');
Route::get('/suitestab', [RoomSuiteController::class, 'suites'])->name('suitestab');
Route::get('/roomtab/{name}', [RoomSuiteController::class, 'roominfo']);
Route::get('/suitestab/{name}', [RoomSuiteController::class, 'suiteinfo']);
Route::get('/hotelfaq', [FaqController::class, 'index'])->name('faq');
Route::get('/hotelpolicies', [PoliciesController::class, 'index'])->name('policies');
Route::get('/reservationpolicy', [ReservationPoliciesController::class, 'index'])->name('reservationpolicies');
Route::get('/aboutus', [AboutusController::class, 'index'])->name('aboutus');

Route::resource('/book', BookController::class);
Route::resource('/chooseroom', ChooseRoomController::class);
Route::resource('/bookinfo', BookInformationController::class);
Route::resource('/search', SearchModifyController::class);

Route::get('stripe', [StripeController::class, 'stripe'])->middleware('verified');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post')->middleware('verified');

Auth::routes(['verify' => true]);

Route::resource('/modify', ModifyReservationController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    echo 'email sent!';
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
