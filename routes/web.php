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
    HomeController,
    OwnerDashboardController,
    ProductController
};

// Default redirect ke login dulu
Route::get('/', fn() => redirect()->route('login'));

// Auth routes (login, register, logout)
Auth::routes();

// Semua route di bawah ini butuh login
Route::middleware(['auth'])->group(function () {

    /**
     *  Kasir & Owner
     * Termasuk: Transaksi, Pembayaran, Reservasi, Dashboard Kasir
     */
    Route::middleware('role:kasir,owner')->group(function () {
        Route::resource('orders', OrderController::class);
        Route::get('orders/{order}/receipt', [OrderController::class, 'printReceipt'])->name('orders.receipt');

        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');

        Route::resource('reservations', ReservationController::class);
        Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])
            ->name('reservations.updateStatus');

        Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');
        // Dashboard Kasir
Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])
    ->name('kasir.dashboard');

// Alias tambahan biar tidak error kalau ada yang panggil kasir.index
Route::get('/kasir', [KasirDashboardController::class, 'index'])
    ->name('kasir.index');

    });

    /**
     *  Owner saja
     * Termasuk: Dashboard Owner, Produk, Kategori, Laporan, Akun Kasir
     */
    Route::middleware('role:owner')->group(function () {
        // Dashboard Owner
        Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])
            ->name('owner.dashboard');

        // CRUD Products
        Route::resource('products', ProductController::class);

        // CRUD Categories & Items
        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemsController::class);

        // Laporan
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf', [ReportController::class, 'exportPDF'])->name('reports.pdf');
        Route::get('reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    });

    /**
     *  Fallback route 'dashboard'
     *  → otomatis redirect sesuai role login
     */
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->hasRole('owner')) {
            return redirect()->route('owner.dashboard');
        } elseif ($user->hasRole('kasir')) {
            return redirect()->route('kasir.dashboard');
        } else {
            abort(403, 'Unauthorized action.');
        }
    })->name('dashboard');
});

// Default redirect untuk /home
Route::get('/home', [HomeController::class, 'index'])->name('home');
