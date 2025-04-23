<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Articles;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}) -> name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // rutas para companies -----------------------------------------------------------------
    Route::get('/machines', [DashboardController::class, 'machines'])->name('machines');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('orders');
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');


    // vista articulos para tienda -----------------------------------------------------------
    Route::get('articles', Articles::class) -> name('articles');
});
