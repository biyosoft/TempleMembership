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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for the Item Controller
Route::get('/items/add',[itemController::class,'index'])->name('items.add');
Route::post('/items/store',[itemController::class,'store'])->name('items.store');
Route::delete('/items/destroy/{id}',[itemController::class,'destroy'])->name('items.destroy');

//Routes For the member controller
Route::get('members/add',[membersController::class,'index'])->name('members.add');
Route::view('members/show','members/show')->name('members.show');
Route::post('members/store',[membersController::class,'store'])->name('members.store');
Route::get('/members/edit/{id}',[membersController::class,'edit'])->name('members.edit');
Route::put('/members/update/{id}',[membersController::class,'update'])->name('members.update');
Route::delete('members/destroy/{id}',[membersController::class,'destroy'])->name('members.destroy');

});

//Routes for the payments controller

Route::get('payments/add',[paymentController::class,'index'])->name('payments.add');
Route::post('payments/store',[paymentController::class,'store'])->name('payments.store');

