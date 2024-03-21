<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalatTimeController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/locations', [SalatTimeController::class, 'getLocations']);
Route::get('/date_limits', [SalatTimeController::class, 'getMinMaxDate']);
Route::get('/salat-time', [SalatTimeController::class, 'getSalatTime']);
