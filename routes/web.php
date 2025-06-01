<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CompanyDashboardController;
use App\Livewire\AdminDashboard\Category\Categories;
use App\Livewire\AdminDashboard\Main;
use App\Livewire\AdminDashboard\Order\VisualizerOrder as OrderVisualizerOrder;
use App\Livewire\Articles;
use App\Livewire\Companies\CreateNotifications;
use App\Livewire\Companies\Orders;
use App\Livewire\Companies\Notifications;
use App\Livewire\Companies\VisualizerNotification;
use App\Livewire\Companies\VisualizerOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// vista articulos para tienda -----------------------------------------------------------
Route::get('articles', Articles::class)->name('articles');
Route::get('articles/article/{article}', [Articles::class, 'show'])->name('article.show');


// carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');


// logueados ----------------------------------------------------------------------------------------------------------
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // solo empresas
    Route::middleware(['role:company'])->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

        // rutas para companies -----------------------------------------------------------------
        Route::get('companies/machines', [CompanyDashboardController::class, 'machines'])->name('machines');
        Route::get('companies/orders', Orders::class)->name('orders');
        Route::get('companies/notifications', Notifications::class)->name('notifications');

        // añadir articulo al carrito
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        //eliminar articulo del carrito
        Route::delete('/cart/delete/{article}', [CartController::class, 'destroy'])->name('cart.destroy');
        // actualizar cantidad
        Route::patch('/cart/update/{article}', [CartController::class, 'updateQuantity'])->name('cart.update');
        // vaciar el carrito
        Route::post('/cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty');
    });



    // solo admin
    Route::middleware(['role:admin'])->group(function () {
        // rutas admin
        Route::get('/admin-dashboard', Main::class)->name('admin-dashboard');
        Route::get('/admin-dashboard/categories', Categories::class);
    });


    // ruta para visualizar y editar pedidos
    Route::get('/companies/orders/visualizer-order/{id}', VisualizerOrder::class)->name('visualizer-order');


    // ruta para crear avisos 
    Route::get('companies/notifications/create', CreateNotifications::class)->name('notifications.create');
    // ruta para visualizar avisos
    Route::get('/companies/notifications/visualizer-notification/{id}', VisualizerNotification::class)->name('visualizer-notification');
});
