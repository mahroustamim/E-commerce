<?php

use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\SettingController;
use Illuminate\Support\Facades\Route;



Route::get('home', [IndexController::class, 'index'])->name('home');

Route::get('setting', [SettingController::class, 'index'])->name('setting');

Route::post('updateOrCreate', [SettingController::class, 'updateOrCreate'])->name('settings.updateOrCreate');