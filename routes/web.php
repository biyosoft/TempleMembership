<?php

use App\Http\Controllers\areaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\itemController;
use App\Http\Controllers\membersController;
use App\Http\Controllers\paymentController;
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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get("/", "index")->name("home");
        Route::get("/home", "index")->name("home");
        Route::get('sync','is_sync')->name('sync');
    });
    Route::resource("items", itemController::class);
    Route::resource("areas" , areaController::class);
    Route::resource('members', membersController::class);
    Route::resource("payments", paymentController::class);
    Route::get('/export', [paymentController::class, 'export'])->name('payments.export');
    Route::get('/export_page', [paymentController::class, 'export_page'])->name('payments.export_page');
    Route::group(['prefix' => 'payments'], function () {
        Route::get("member_payments/{id}", [paymentController::class, 'member_payments'])->name('payments.member_payments');
    });
    Route::get('payments/receipt/{id}',[paymentController::class,'receipt'])->name('payments.receipt');
});
