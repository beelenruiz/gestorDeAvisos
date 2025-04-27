<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\Articles;
use App\Livewire\Companies\CreateNotifications;
use App\Livewire\Companies\Orders;
use App\Livewire\Companies\Notifications;
use App\Livewire\Companies\VisualizerOrder;
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
    Route::get('commpanies/orders', Orders::class) -> name('orders');
    Route::get('notifications', Notifications::class) -> name('notifications');


    // vista articulos para tienda -----------------------------------------------------------
    Route::get('articles', Articles::class) -> name('articles');
    

    // ruta para crear avisos 
    Route::get('/notifications/create', CreateNotifications::class) -> name('notifications.create');


    // ruta para visualizar y editar pedidos
    Route::get('/companies/orders/visualizer-order/{id}', VisualizerOrder::class) -> name('visualizer-order');
});
