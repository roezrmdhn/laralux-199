<?php

use App\Http\Controllers\Customers\CartController;
use App\Http\Controllers\Customers\CheckoutController;
use App\Http\Controllers\Customers\HistoryController;
use App\Http\Controllers\Customers\HomeController;
use App\Http\Controllers\Customers\ProductController;
use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\CustomerController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\FacilitiesController;
use App\Http\Controllers\Staff\HotelController;
use App\Http\Controllers\Staff\HotelTypeController;
use App\Http\Controllers\Staff\JenisController;
use App\Http\Controllers\Staff\MembershipController;
use App\Http\Controllers\Staff\RoomController;
use App\Http\Controllers\Staff\RoomTypeController;
use App\Http\Controllers\Staff\TipeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['as' => 'homepage.'], function () {
    Route::get('/shop', [ProductController::class, 'index'])->name('shop');
    Route::get('/detail-product/{id}', [ProductController::class, 'detail']);
});

// Route::middleware(['auth'])->group(function () {
Route::middleware(['auth', 'checkRole:Customer'])->group(function () {
    Route::group(['as' => 'cart.'], function () {
        Route::get('/cart', [CartController::class, 'index'])->name('index');
        Route::post('/add-to-cart/{id}', [CartController::class, 'addCart'])->name('add');
        Route::get('/remove-from-cart/{id}', [CartController::class, 'destroy'])->name('remove');
    });
    Route::group(['as' => 'checkout.'], function () {
        Route::post('/checkout', [CheckoutController::class, 'index'])->name('index');
        Route::post('/checkout-data', [CheckoutController::class, 'store'])->name('store');
    });
    Route::group(['as' => 'history.'], function () {
        Route::get('/riwayat-order', [HistoryController::class, 'index'])->name('index');
        Route::get('/riwayat-detail/{id}', [HistoryController::class, 'detail'])->name('detail');
    });
});
Route::middleware(['auth'])->group(function () {
    // Route::middleware(['auth', 'checkRole:Staff'])->group(function () {
    Route::group(['as' => 'room.'], function () {
        Route::get('/data-room', [RoomController::class, 'index'])->name('index');
        Route::resource('room', RoomController::class);
        Route::post('/update-room/{id}', [RoomController::class, 'updateStatusRoom'])->name('updateStatusRoom');
    });
    Route::group(['as' => 'hotel.'], function () {
        Route::get('/data-hotel', [HotelController::class, 'index']);
        Route::resource('hotels', HotelController::class);
    });
    Route::group(['as' => 'fasilitas.'], function () {
        Route::get('/data-fasilitas', [FacilitiesController::class, 'index']);
        Route::resource('fasilitas', FacilitiesController::class);
    });
    Route::group(['as' => 'hotel-type.'], function () {
        Route::get('/data-hotel-type', [HotelTypeController::class, 'index']);
        Route::resource('hotel-type', HotelTypeController::class);
    });
    Route::group(['as' => 'room-type.'], function () {
        Route::get('/data-room-type', [RoomTypeController::class, 'index']);
        Route::resource('room-type', RoomTypeController::class);
    });
    Route::group(['as' => 'membership.'], function () {
        Route::get('/data-membership', [MembershipController::class, 'index']);
        Route::resource('membership', MembershipController::class);
    });
});

// Route::middleware(['auth', 'checkRole:Owner'])->group(function () {
//     Route::group(['as' => 'membership.'], function () {
//         Route::get('/data-membership', [MembershipController::class, 'index']);
//         Route::resource('membership', MembershipController::class);
//     });
//     Route::middleware(['auth', 'checkRole:Owner'])->group(function () {
//         Route::group(['as' => 'room.'], function () {
//             Route::get('/data-room', [RoomController::class, 'index']);
//             Route::resource('room', RoomController::class);
//         });
//         Route::group(['as' => 'hotel.'], function () {
//             Route::get('/data-hotel', [HotelController::class, 'index']);
//             Route::resource('hotels', HotelController::class);
//         });
//         Route::group(['as' => 'fasilitas.'], function () {
//             Route::get('/data-fasilitas', [FacilitiesController::class, 'index']);
//             Route::resource('fasilitas', FacilitiesController::class);
//         });
//         Route::group(['as' => 'hotel-type.'], function () {
//             Route::get('/data-hotel-type', [HotelTypeController::class, 'index']);
//             Route::resource('hotel-type', HotelTypeController::class);
//         });
//         Route::group(['as' => 'room-type.'], function () {
//             Route::get('/data-room-type', [RoomTypeController::class, 'index']);
//             Route::resource('room-type', RoomTypeController::class);
//         });
//     });
// });
require __DIR__ . '/auth.php';
