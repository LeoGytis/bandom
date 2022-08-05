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


Route::group(['prefix' => 'countries'], function(){
    Route::get('', [Country::class, 'index'])->name('country.index');
    Route::get('create', [Country::class, 'create'])->name('country.create');
    Route::post('store', [Country::class, 'store'])->name('country.store');
    Route::get('edit/{country}', [Country::class, 'edit'])->name('country.edit');
    Route::post('update/{country}', [Country::class, 'update'])->name('country.update');
    Route::post('delete/{country}', [Country::class, 'destroy'])->name('country.destroy');
    Route::get('show/{country}', [Country::class, 'show'])->name('country.show');
 });
 