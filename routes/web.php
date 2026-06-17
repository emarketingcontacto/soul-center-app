<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExternalServiceController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/', WelcomeController::class);

// Rutas para los Servicios de Especialistas Externos
Route::get('/servicios/{slug}', [ExternalServiceController::class, 'show'])->name('external.services.show');
Route::get('/servicios/{slug}/click', [ExternalServiceController::class, 'trackClick'])->name('external.services.click');

// Rutas para los Servicios Internos del Spa
Route::get('/{category}/{slug}', [ServiceController::class, 'show'])->name('services.show');
