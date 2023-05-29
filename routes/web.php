<?php

use App\Http\Controllers\agent\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::resource('/', LandingPageController::class);
Route::prefix('flight')->name('flight.')->middleware('auth', 'agent')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::prefix('flight')->name('flight.')->middleware('auth')->group(function () {
    Route::get('{origin}/{destination}/{trip_type}/{flight_type}/{cdeparture}/{adult}/{children}/{infant}', [FlightSearchController::class, 'oneway'])->name('search.oneway');
    Route::get('{origin}/{destination}/{trip_type}/{flight_type}/{cdeparture}/{return}/{adult}/{children}/{infant}', [FlightSearchController::class, 'return'])->name('search.return');
    Route::resource('search', FlightSearchController::class);
    Route::resource('booking', BookingController::class);
});



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/agent.php';
