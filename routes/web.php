<?php

use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::resource('/', LandingPageController::class);
Route::prefix('flight')->name('flight')->group(function () {
    Route::get('{origin}/{destination}/{trip_type}/{flight_type}/{cdeparture}/{adult}/{children}/{infant}', [FlightSearchController::class, 'oneway'])->name('search.oneway');
});

require __DIR__ . '/auth.php';
