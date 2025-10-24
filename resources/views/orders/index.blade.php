@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <!-- Total Orders -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Orders</h6>
                    <h3 class="fw-bold text-primary">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        <!-- Transaksi Hari Ini -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Transaksi Hari Ini</h6>
                    <h3 class="fw-bold text-primary">Rp {{ number_format($totalTransaksiHariIni,0,',','.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Unpaid Orders -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Unpaid Orders</h6>
                    <h3 class="fw-bold text-warning">{{ $unpaidOrders }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <h6 class="text-muted">Total Pendapatan</h6>
                    <h3 class="fw-bold text-success">Rp {{ number_format($totalPendapatan,0,',','.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Recent Orders</h5>
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
