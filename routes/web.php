<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::resource('/', LandingPageController::class);

require __DIR__ . '/auth.php';
