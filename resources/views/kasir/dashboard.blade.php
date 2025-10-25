@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0f2fe, #eef2ff, #f0f9ff);
        min-height: 100vh;
        padding: 30px;
        font-family: 'Poppins', sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        padding: 25px 30px;
        transition: 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-2px);
    }

    .card-header {
        background: rgba(59, 130, 246, 0.7);
        color: white;
        border: none;
        border-radius: 16px;
        font-weight: 600;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .badge.bg-light {
        background: rgba(255, 255, 255, 0.4) !important;
        color: #1e293b !important;
        font-weight: 500;
    }

    .alert {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 12px;
        color: #065f46;
        font-weight: 500;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(15px);
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        transition: all 0.25s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    }

    .info-card h3 {
        font-weight: 600;
        margin-top: 8px;
    }

    .table {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(12px);
        border-radius: 12px;
        overflow: hidden;
    }

    .table th {
        background: rgba(255, 255, 255, 0.55);
        font-weight: 600;
        color: #334155;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        border-radius: 12px;
        padding: 8px 14px;
        font-weight: 500;
        transition: 0.25s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
        transform: translateY(-2px);
    }

    hr {
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 768px) {
        .card-header h4 {
            font-size: 1.2rem;
        }
        .card-header span {
            font-size: 0.85rem;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card">

                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-cash-stack me-2"></i> Dashboard Kasir</h4>
                    <span class="badge bg-light text-dark">
                        Kasir Aktif: {{ Auth::user()->name }}
                    </span>
                </div>

                <div class="card-body mt-4">
                    <div class="alert alert-success mb-4">
                        <strong>Selamat datang, {{ Auth::user()->name }}!</strong><br>
                        Anda berhasil login sebagai <b>Kasir</b>.
                    </div>

                    <div class="row g-4 mb-4">
                        <!-- Transaksi Hari Ini -->
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <h6 class="text-muted mb-1">Transaksi Hari Ini</h6>
                                <h3 class="text-primary">{{ $totalTransaksiHariIni }}</h3>
                            </div>
                        </div>

                        <!-- Total Pendapatan -->
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <h6 class="text-muted mb-1">Total Pendapatan</h6>
                                <h3 class="text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            </div>
                        </div>

                        <!-- Produk Terjual -->
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <h6 class="text-muted mb-1">Produk Terjual</h6>
                                <h3 class="text-info">{{ $produkTerjual }}</h3>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-semibold">Daftar Transaksi Terakhir</h5>
                        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Buat Transaksi Baru
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-hover mb-0">
                            <thead>
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
                                        <td colspan="5" class="text-center text-muted py-3">
                                            Belum ada transaksi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
