<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Items;
use App\Models\User;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        // Contoh data statistik (opsional)
        $totalOrders = Order::count();
        $totalItems = Items::count();
        $totalCashiers = User::where('role', 'kasir')->count();
        $todaySales = Order::whereDate('created_at', today())->sum('total');

        return view('owner.dashboard', compact(
            'totalOrders', 'totalItems', 'totalCashiers', 'todaySales'
        ));
    }
}
