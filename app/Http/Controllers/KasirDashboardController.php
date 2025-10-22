<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // ✅ Total transaksi hari ini
        $totalTransaksiHariIni = Order::whereDate('created_at', $today)->count();

        // ✅ Total pendapatan (semua transaksi)
        $totalPendapatan = Order::sum('total_harga');

        // ✅ Total produk terjual
        // Pastikan tabel order_items punya kolom 'jumlah'
        $produkTerjual = OrderItem::sum('jumlah');

        // ✅ Ambil transaksi terbaru (misal 5 terakhir)
        $transaksiTerakhir = Order::latest()->take(5)->get();

        return view('kasir.dashboard', compact(
            'totalTransaksiHariIni',
            'totalPendapatan',
            'produkTerjual',
            'transaksiTerakhir'
        ));
    }
}
