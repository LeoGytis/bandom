<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as Country;
use App\Http\Controllers\HotelController as Hotel;

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
    Route::get('', [Country::class, 'index'])->name('country.index');
    Route::get('create', [Country::class, 'create'])->name('country.create');
    Route::post('store', [Country::class, 'store'])->name('country.store');
    Route::get('edit/{country}', [Country::class, 'edit'])->name('country.edit');
    Route::post('update/{country}', [Country::class, 'update'])->name('country.update');
    Route::post('delete/{country}', [Country::class, 'destroy'])->name('country.destroy');
    Route::get('show/{country}', [Country::class, 'show'])->name('country.show');
 });
 
// ========================== Hotel ==========================
 Route::group(['prefix' => 'hotels'], function(){
    Route::get('', [Hotel::class, 'index'])->name('hotel.index');
    Route::get('create', [Hotel::class, 'create'])->name('hotel.create');
    Route::post('store', [Hotel::class, 'store'])->name('hotel.store');
    Route::get('edit/{hotel}', [Hotel::class, 'edit'])->name('hotel.edit');
    Route::post('update/{hotel}', [Hotel::class, 'update'])->name('hotel.update');
    Route::post('delete/{hotel}', [Hotel::class, 'destroy'])->name('hotel.destroy');
    Route::get('show/{hotel}', [Hotel::class, 'show'])->name('hotel.show');
 });
 