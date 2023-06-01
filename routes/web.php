<?php

use App\Http\Controllers\agent\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReIssueController;
use Illuminate\Support\Facades\Route;

Route::resource('/', LandingPageController::class);
Route::prefix('flight')->name('flight.')->middleware('auth', 'agent')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::prefix('flight')->name('flight.')->middleware('auth')->group(function () {
    Route::get('{origin}/{destination}/oneway/{flight_type}/{cdeparture}/{adult}/{children}/{infant}', [FlightSearchController::class, 'oneway'])->name('search.oneway');
    Route::get('{origin}/{destination}/return/{flight_type}/{cdeparture}/{return}/{adult}/{children}/{infant}', [FlightSearchController::class, 'return'])->name('search.return');
    Route::get('{origin1}/{destination1}/{departureDate1}/{origin2}/{destination2}/{departureDate2}/{adult}/{children}/{infant}', [FlightSearchController::class, 'multiCity'])->name('search.multiCity');

    Route::resource('search', FlightSearchController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('reissue', ReIssueController::class);
});

Route::get('/flight/booking/{id}/{hash}', [BookingController::class, 'ticket'])->name('flight.ticket.show.passenger');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/agent.php';
