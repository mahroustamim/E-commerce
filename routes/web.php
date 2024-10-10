<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\IndexController;
use App\Http\Controllers\website\OrderController;
use App\Http\Controllers\website\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
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

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest');

// when user logout go to website-home
Route::get('/', [IndexController::class, 'index'])->name('home');


Route::middleware(['checkVerifiedEmail', 'throttle:website'])->prefix('website/')->name('website.')->group(function () {

    Route::get('home', [IndexController::class, 'index'])->name('home');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('categories', [IndexController::class, 'categories'])->name('categories');

    Route::get('products', [IndexController::class, 'products'])->name('products');

    Route::get('about', [IndexController::class, 'about'])->name('about');

    Route::get('contact', [IndexController::class, 'contact'])->name('contact');

    Route::post('contact', [IndexController::class, 'sendContact'])->name('contact');

    Route::get('cart/{id}', [CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'addCart'])->name('cart.add');

    Route::post('/rating', [CartController::class, 'rating'])->name('rating');

    Route::post('/comment', [CartController::class, 'comment'])->name('comment');

    Route::get('shopping_cart', [CartController::class, 'shoppingCart'])->name('shopping_cart');

    Route::post('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

    Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::get('checkout', [OrderController::class, 'index'])->name('checkout');

    Route::post('checkout', [OrderController::class, 'store'])->name('order.store');

    Route::get('delivery-price/{id}', [OrderController::class, 'deliveryPrice'])->name('deliveryPrice');

    Route::get('set-locale/{locale}', [LocalizationController::class, 'setLocale'])->name('set-locale');

    Route::get('test', function(Request $request) {
    });

});




