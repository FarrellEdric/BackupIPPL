<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    OrderController,
    ReportController,
    PaymentController,
    CategoryController,
    ReservationController,
    KasirDashboardController,
    ItemsController,
    HomeController
};

Route::get('/', fn() => redirect()->route('kasir.dashboard'));

Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Kasir + Owner
    Route::middleware('role:kasir,owner')->group(function () {
        Route::resource('orders', OrderController::class);
        Route::get('orders/{order}/receipt', [OrderController::class, 'printReceipt'])->name('orders.receipt');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::resource('reservations', ReservationController::class);
        Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
        Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');
    });

    // Owner saja
    Route::middleware('role:owner')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemsController::class);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf', [ReportController::class, 'exportPDF'])->name('reports.pdf');
        Route::get('reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
