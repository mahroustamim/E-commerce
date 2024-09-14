<?php

use App\Http\Controllers\website\ProfileController;
use App\Http\Controllers\website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


Route::middleware(['checkVerifiedEmail'])->prefix('website')->name('website.')->group(function () {

    Route::get('home', [IndexController::class, 'index'])->name('home');

    Route::get('profile{id}', [ProfileController::class, 'index'])->name('profile');
    
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('categories', [IndexController::class, 'categories'])->name('categories');
});




