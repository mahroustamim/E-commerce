<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;






Route::get('home', [IndexController::class, 'index'])->name('home');

Route::get('setting', [SettingController::class, 'index'])->name('setting');

Route::post('updateOrCreate', [SettingController::class, 'updateOrCreate'])->name('settings.updateOrCreate');

Route::resources([
    'categories' => CategoryController::class,
    'products'    => ProductController::class,
]);

Route::post('categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

Route::post('products/delete', [ProductController::class, 'delete'])->name('products.delete');

Route::post('products/status', [ProductController::class, 'changStatus'])->name('products.status');

Route::get('set-locale/{locale}', [LocalizationController::class, 'setLocale']);

Route::get('orders/pending', [OrderController::class, 'pending'])->name('orders.pending');

Route::get('orders/delivering', [OrderController::class, 'delivering'])->name('orders.delivering');

Route::get('orders/completed', [OrderController::class, 'completed'])->name('orders.completed');

Route::post('orders/status/{id}', [OrderController::class, 'changeStatus'])->name('orders.status');