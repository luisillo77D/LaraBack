<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\PagoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/clientes', [ClienteController::class, 'store']);
Route::get('/clientes/{cliente}', [ClienteController::class, 'show']);
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy']);

Route::get('/prestamos', [PrestamoController::class, 'index']);
Route::post('/prestamos', [PrestamoController::class, 'store']);
Route::get('/prestamos/{prestamo}', [PrestamoController::class, 'show']);
Route::put('/prestamos/{prestamo}', [PrestamoController::class, 'update']);
Route::delete('/prestamos/{prestamo}', [PrestamoController::class, 'destroy']);

Route::get('/pagos/{pago}', [PagoController::class, 'index']);
Route::post('/pagos', [PagoController::class, 'store']);
Route::put('/pagos/status/{pago}', [PagoController::class, 'updateStatus']);