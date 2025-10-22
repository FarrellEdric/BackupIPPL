{{-- File: resources/views/auth/verify.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
{{-- 
  Kita tidak perlu icon mata di sini, jadi CDN Bootstrap Icons
  bisa dihapus jika halaman ini tidak menggunakannya.
  Tapi tidak apa-apa jika dibiarkan.
--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /*
     * Menggunakan style dasar yang sama dengan login/register
     */
    .verify-wrapper {
        background: linear-gradient(135deg, #89f7fe, #66a6ff);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .card.verify-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        padding: 1.5rem;
    }

    .card-header.verify-header {
        background: transparent;
        border: none;
        text-align: center;
        font-weight: 600;
        font-size: 1.8rem;
        color: #333;
        padding-top: 0;
        padding-bottom: 0.5rem;
    }

    /*
     * Tombol "Kirim Ulang"
     * Kita buat style-nya sama dengan tombol Login
     */
    .btn-primary.btn-verify {
        background: #66a6ff;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%; /* Buat tombol full-width */
        text-decoration: none; /* Hilangkan underline jika aslinya link */
        color: white;
    }

    .btn-primary.btn-verify:hover {
        background: #4a8efc;
        transform: translateY(-2px);
        color: white;
    }

    .brand-title {
        text-align: center;
        font-weight: 700;
        color: #004aad;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }
    
    /* * Style untuk text di dalam card-body
     */
    .verify-text {
        font-size: 1rem; /* 16px */
        color: #555;
        margin-bottom: 0.5rem;
    }
    .verify-text-small {
        font-size: 0.9rem; /* 14px */
        color: #666;
        margin-bottom: 1.5rem; /* Jarak ke tombol */
    }

    /* * Style untuk alert/pesan sukses
     */
    .alert.verify-alert {
        border-radius: 10px;
        border: 1px solid #badbcc;
        font-size: 0.95rem;
    }

</style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
<div class="verify-wrapper">
    
    {{-- Menggunakan kolom responsif yang sama --}}
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="card verify-card">
            <div class="brand-title">POS Me Time</div>
            <div class="card-header verify-header">{{ __('Verifikasi Email Anda') }}</div>

            {{-- 
              Kita tambahkan text-center agar konten di body 
              (teks, alert, tombol) terlihat rapi di tengah
            --}}
            <div class="card-body text-center">

                @if (session('resent'))
                    <div class="alert alert-success verify-alert" role="alert">
                        {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                    </div>
                @endif

                <p class="verify-text">
                    {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.') }}
                </p>
                <p class="verify-text-small">
                    {{ __('Jika Anda tidak menerima email') }},
                </p>
                
                {{-- 
                  Kita ubah form-nya dari 'd-inline' menjadi 'd-block'
                  agar tombolnya bisa full-width
                --}}
                <form class="d-block" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    {{-- 
                      Kita ganti tombol 'btn-link' menjadi 'btn-verify'
                      agar konsisten
                    --}}
                    <button type="submit" class="btn btn-primary btn-verify">
                        {{ __('klik di sini untuk kirim ulang') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

{{-- Tidak perlu @push('scripts') karena tidak ada JavaScript di halaman ini --}}