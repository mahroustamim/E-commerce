<?php

use App\Http\Controllers\dashboard\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('home', [IndexController::class, 'index'])->name('home');