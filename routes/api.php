<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('address')->controller(AddressController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::post('/', 'create');
    Route::delete('/', 'delete');
});

Route::prefix('states')->controller(StateController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{code}', 'show');
});

Route::prefix('city')->controller(CityController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});
