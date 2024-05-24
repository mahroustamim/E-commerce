<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ColorSizeController;
use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\ProductArchivesController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\ProductImageController;
use App\Http\Controllers\dashboard\SettingController;
use Illuminate\Support\Facades\Route;






Route::get('home', [IndexController::class, 'index'])->name('home');

Route::get('settings/index', [SettingController::class, 'index'])->name('settings.index');

Route::post('settings/updateOrCreate', [SettingController::class, 'updateOrCreate'])->name('settings.updateOrCreate');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::post('categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

Route::put('categories/update', [CategoryController::class, 'update'])->name('categories.update');

Route::resource('products', ProductController::class);

Route::post('products/delete', [ProductController::class, 'delete'])->name('products.delete');

Route::get('products/archives/index', [ProductArchivesController::class, 'index'])->name('products.archives.index');

Route::post('products/archives/restore', [ProductArchivesController::class, 'restore'])->name('products.archives.restore');

Route::delete('products/archives/destroy', [ProductArchivesController::class, 'destroy'])->name('products.archives.delete');

Route::post('products/status', [ProductController::class, 'changStatus'])->name('products.status');

Route::get('products/images/index/{id}', [ProductImageController::class, 'images'])->name('products.images.index');

Route::post('products/images/store/{id}', [ProductImageController::class, 'storeImages'])->name('products.images.store');

Route::post('products/images/delete/{image}', [ProductImageController::class, 'deleteImages'])->name('products.images.delete');

Route::get('products/colorSize/index/{id}', [ColorSizeController::class, 'index'])->name('products.colorsize.index');

Route::post('products/colorSize/store/{id}', [ColorSizeController::class, 'store'])->name('products.colorsize.store');

// Route::post('products/colorSize/delete/{image}', [ColorSizeController::class, 'deleteImages'])->name('products.colorsize.delete');