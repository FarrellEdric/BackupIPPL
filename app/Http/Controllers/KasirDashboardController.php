<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $data = Dashboard::getKasirSummary();

        return view('kasir.dashboard', [
            'orders' => $data['recentOrders'],
            'totalOrders' => $data['totalOrders'],
            'totalToday' => $data['totalToday'],
            'unpaidOrders' => $data['unpaidOrders'],
        ]);
    }
}
