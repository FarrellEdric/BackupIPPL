<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Carbon\Carbon;

class Dashboard extends Model
{
    // Model ini tidak berhubungan langsung dengan tabel
    protected $table = false;
    public $timestamps = false;

    /**
     * Ambil data ringkasan untuk dashboard kasir
     */
    public static function getKasirSummary()
    {
        $today = Carbon::today();

        return [
            'totalOrders' => Order::count(),
            'totalToday' => Order::whereDate('created_at', $today)->sum('total'),
            'unpaidOrders' => Order::where('status', 'unpaid')->count(),
            'recentOrders' => Order::latest()->take(10)->get(),
        ];
    }

    /**
     * Ambil data ringkasan untuk dashboard owner
     */
    public static function getOwnerSummary()
    {
        $today = Carbon::today();

        return [
            'totalOrders' => Order::count(),
            'totalToday' => Order::whereDate('created_at', $today)->sum('total'),
            'paidOrders' => Order::where('status', 'paid')->count(),
            'incomeThisMonth' => Order::whereMonth('created_at', $today->month)->sum('total'),
            'recentOrders' => Order::latest()->take(5)->get(),
        ];
    }
}
