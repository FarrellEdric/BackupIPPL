@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-cash-stack"></i> Dashboard Kasir</h4>
                    <span class="badge bg-light text-dark">Kasir Aktif: {{ Auth::user()->name }}</span>
                </div>

                <div class="card-body">
                    <div class="alert alert-success mb-4">
                        <strong>Selamat datang, {{ Auth::user()->name }}!</strong>  
                        Anda berhasil login sebagai <b>Kasir</b>.
                    </div>

                    <div class="row g-4">
                        <!-- Total Transaksi Hari Ini -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="text-muted">Transaksi Hari Ini</h6>
                                    <h3 class="fw-bold text-primary">{{ $totalTransaksiHariIni }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Total Pendapatan -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="text-muted">Total Pendapatan</h6>
                                    <h3 class="fw-bold text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Terjual -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="text-muted">Produk Terjual</h6>
                                    <h3 class="fw-bold text-info">{{ $produkTerjual }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Daftar Transaksi Terakhir</h5>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Buat Transaksi Baru
                        </a>
                    </div>

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerakhir as $index => $t)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $t->created_at->format('d M Y') }}</td>
                                    <td>{{ $t->nama_pelanggan ?? '-' }}</td>
                                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($t->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($t->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($t->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
