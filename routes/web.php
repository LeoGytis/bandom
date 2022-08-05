<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as Country;
use App\Http\Controllers\HotelController as Hotel;
use App\Http\Controllers\OrderController as O;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========================== Country ==========================
Route::group(['prefix' => 'countries'], function(){
    Route::get('', [Country::class, 'index'])->name('country.index')->middleware('rp:user');
    Route::get('create', [Country::class, 'create'])->name('country.create')->middleware('rp:admin');
    Route::post('store', [Country::class, 'store'])->name('country.store')->middleware('rp:admin');
    Route::get('edit/{country}', [Country::class, 'edit'])->name('country.edit')->middleware('rp:admin');
    Route::post('update/{country}', [Country::class, 'update'])->name('country.update')->middleware('rp:admin');
    Route::post('delete/{country}', [Country::class, 'destroy'])->name('country.destroy')->middleware('rp:admin');
    Route::get('show/{country}', [Country::class, 'show'])->name('country.show')->middleware('rp:user');
 });
 
// ========================== Hotel ==========================
 Route::group(['prefix' => 'hotels'], function(){
    Route::get('', [Hotel::class, 'index'])->name('hotel.index')->middleware('rp:user');
    Route::get('create', [Hotel::class, 'create'])->name('hotel.create')->middleware('rp:admin');
    Route::post('store', [Hotel::class, 'store'])->name('hotel.store')->middleware('rp:admin');
    Route::get('edit/{hotel}', [Hotel::class, 'edit'])->name('hotel.edit')->middleware('rp:admin');
    Route::post('update/{hotel}', [Hotel::class, 'update'])->name('hotel.update')->middleware('rp:admin');
    Route::post('delete/{hotel}', [Hotel::class, 'destroy'])->name('hotel.destroy')->middleware('rp:admin');
    Route::get('show/{hotel}', [Hotel::class, 'show'])->name('hotel.show')->middleware('rp:user');
 });
 

 // ========================== Order ==========================

// Route::post('add-service-to-order', [O::class, 'add'])->name('front-add');
// Route::get('my-orders', [O::class, 'showMyOrders'])->name('my-orders');

Route::prefix('orders')->name('orders-')->group(function () {
    Route::post('add', [O::class, 'add'])->name('add')->middleware('rp:admin');
    Route::get('show', [O::class, 'showMyOrders'])->name('show')->middleware('rp:admin');
    Route::post('delete/{order}', [O::class, 'destroy'])->name('destroy')->middleware('rp:admin');
    Route::post('approve/{order}', [O::class, 'approve'])->name('approve')->middleware('rp:admin');
    Route::put('status/{order}', [O::class, 'setStatus'])->name('status')->middleware('rp:admin');


    // Route::get('', [O::class, 'index'])->name('index');
    // Route::get('/pdf/{order}', [O::class, 'getPdf'])->name('pdf');
});