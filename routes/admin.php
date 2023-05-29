<?php

use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\PassengerController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('passenger', PassengerController::class);
    Route::resource('users', UserController::class);
    Route::resource('finance', FinanceController::class);
    Route::resource('setting', SettingController::class);
});
