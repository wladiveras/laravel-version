<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StoveController;

Route::prefix('/user')->controller(UserController::class)->group(function () {
    Route::post('/', 'store');
    Route::post('/auth', 'auth');
    Route::get('/all', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('stove')->controller(StoveController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/all', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('address')->controller(AddressController::class)->group(function () {
    Route::get('/all', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
});

Route::prefix('state')->controller(StateController::class)->group(function () {
    Route::get('/all', 'index');
    Route::get('/{code}', 'show');
});

Route::prefix('city')->controller(CityController::class)->group(function () {
    Route::get('/all', 'index');
    Route::get('/{id}', 'show');
});
