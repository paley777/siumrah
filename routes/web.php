<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\InventoryController;

//Landing Login
Route::get('/', [LandingController::class, 'index'])->name('login');
Route::post('/', [LandingController::class, 'authenticate']);

//Dashboard
Route::middleware('auth')
    ->prefix('/dashboard')
    ->group(function () {
        //Index
        Route::get('/', [DashboardController::class, 'index']);

        //Manajemen Data
        Route::resource('/participant', ParticipantController::class);
        Route::resource('/inventory', InventoryController::class);

        //Logout
        Route::post('/logout', [DashboardController::class, 'logout']);
    });
