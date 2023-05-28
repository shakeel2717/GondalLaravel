<?php

use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('booking', BookingController::class);
});
