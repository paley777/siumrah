<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;

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

        //Sistem Transaksi
        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::post('/transaction', [TransactionController::class, 'store']);
        //Invoice
        Route::get('/invoice', [InvoiceController::class, 'index']);
        Route::get('/invoice/{transaction}/print', [InvoiceController::class, 'print']);
        Route::delete('/invoice/{transaction}', [InvoiceController::class, 'destroy']);

        //Report
        Route::get('/report/participant', [ReportController::class, 'participant']);
        Route::get('/report/inventory', [ReportController::class, 'inventory']);
        Route::get('/report/transaction', [ReportController::class, 'transaction']);
        Route::get('/report/order', [ReportController::class, 'order']);

        //Change Password
        Route::get('/my-profile', [DashboardController::class, 'my_profile']);
        Route::get('/my-profile/edit', [DashboardController::class, 'my_profile_edit']);
        Route::post('/my-profile/edit', [DashboardController::class, 'my_profile_store'])->middleware('auth');

        //Logout
        Route::post('/logout', [DashboardController::class, 'logout']);
    });
