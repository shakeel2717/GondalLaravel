<?php

use App\Http\Controllers\agent\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('agent')->name('agent.')->middleware('auth', 'agent')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('transaction', TransactionController::class);
});
