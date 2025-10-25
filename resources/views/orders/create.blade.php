@extends('layouts.app')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #dbeafe, #f0f9ff, #e0e7ff);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
        padding: 20px;
    }

    .glass-card {
        width: 100%;
        max-width: 600px;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-2px);
    }

    .card-header {
        background: transparent;
        border: none;
        font-size: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        background: rgba(255, 255, 255, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 12px;
        padding: 10px 14px;
        color: #0f172a;
        font-size: 1rem;
        transition: 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.4);
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-2px);
    }

    @media (max-width: 576px) {
        .glass-card {
            padding: 20px;
            border-radius: 18px;
        }
        .card-header {
            font-size: 1.4rem;
        }
    }
</style>

<div class="glass-card">
    <div class="card-header">Buat Pesanan Baru</div>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Masukkan nama pelanggan" required>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Pembayaran (Rp)</label>
            <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Contoh: 150000" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Pesanan</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending">Menunggu</option>
                <option value="completed">Selesai</option>
                <option value="canceled">Dibatalkan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_status" class="form-label">Status Pembayaran</label>
            <select class="form-select" id="payment_status" name="payment_status" required>
                <option value="unpaid">Belum Dibayar</option>
                <option value="paid">Sudah Dibayar</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="cash">Tunai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
    </form>
</div>
@endsection
