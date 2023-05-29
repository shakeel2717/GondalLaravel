<?php

use App\Http\Controllers\agent\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('agent')->name('agent.')->middleware('auth', 'agent')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});
