<?php

use App\Http\Controllers\Api\ApartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/results', [ApartmentController::class, 'results']);
Route::get('/apartments/{apartment:slug}', [ApartmentController::class, 'show']);
Route::post('/apartments/search', [ApartmentController::class, 'fuzzySearch']);
Route::post('/apartments', [ApartmentController::class, 'filter']);
