<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;

Route::get('/', fn()=>redirect()->route('orders.index'));

Auth::routes();

Route::middleware(['auth'])->group(function(){

    // Kasir + Owner features
    Route::middleware('role:kasir,owner')->group(function(){
        Route::resource('orders', OrderController::class);
        Route::get('orders/{order}/receipt', [OrderController::class,'printReceipt'])->name('orders.receipt');
        Route::post('payments', [PaymentController::class,'store'])->name('payments.store');
        Route::resource('reservations', ReservationController::class);
        Route::post('reservations/{reservation}/status', [ReservationController::class,'updateStatus'])->name('reservations.updateStatus');
    });

    // Owner only
    Route::middleware('role:owner')->group(function(){
        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemsController::class);
        Route::get('reports', [ReportController::class,'index'])->name('reports.index');
        Route::get('reports/pdf', [ReportController::class,'exportPDF'])->name('reports.pdf');
        Route::get('reports/excel', [ReportController::class,'exportExcel'])->name('reports.excel');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
