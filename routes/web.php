<?php

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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource("items", itemController::class, ['only' => ['index', 'create', 'store']]);
    Route::resource('members', membersController::class);
    Route::resource("payments", paymentController::class);
    Route::group(['prefix' => 'payments'], function () {
        Route::get("member_payments/{id}", [paymentController::class, 'member_payments'])->name('payments.member_payments');
    });
});
