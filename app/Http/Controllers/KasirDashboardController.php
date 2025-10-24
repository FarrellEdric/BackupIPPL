<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 10 order terakhir
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(10)->get();

        $totalOrders = Order::count();

        // Total transaksi hari ini (status paid)
        $totalTransaksiHariIni = Order::whereDate('created_at', $today)
            ->where('status', 'paid')
            ->sum('total');

        // Total unpaid orders
        $unpaidOrders = Order::where('status', 'unpaid')->count();

        // Total pendapatan semua order paid
        $totalPendapatan = Order::where('status', 'paid')->sum('total');
        // KasirDashboardController.php
        $produkTerjual = Order::where('status', 'paid')->count();
        $transaksiTerakhir = Order::orderBy('created_at', 'desc')->limit(10)->get();

        return view('kasir.dashboard', compact(
            'recentOrders',
            'totalOrders',
            'totalTransaksiHariIni',
            'unpaidOrders',
            'totalPendapatan',
            'produkTerjual',
            'transaksiTerakhir'

        ));
    }
}
