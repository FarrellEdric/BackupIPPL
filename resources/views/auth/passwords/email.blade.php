{{-- File: resources/views/auth/passwords/email.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
{{-- 
  Kita tidak perlu icon mata di sini, 
  jadi CDN Bootstrap Icons tidak wajib.
--}}
<style>
    /*
     * Menggunakan style dasar yang sama dengan login/register
     */
    .reset-wrapper {
        background: linear-gradient(135deg, #89f7fe, #66a6ff);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .card.reset-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        padding: 1.5rem;
    }

    .card-header.reset-header {
        background: transparent;
        border: none;
        text-align: center;
        font-weight: 600;
        font-size: 1.8rem;
        color: #333;
        padding-top: 0;
        padding-bottom: 0.5rem;
    }

    .form-control { /* Style ini diambil dari register.blade.php */
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus { /* Style ini diambil dari register.blade.php */
        border-color: #66a6ff;
        box-shadow: 0 0 8px rgba(102, 166, 255, 0.3);
    }

    /*
     * Tombol "Kirim Link"
     */
    .btn-primary.btn-reset {
        background: #66a6ff;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%; /* Buat tombol full-width */
    }

    .btn-primary.btn-reset:hover {
        background: #4a8efc;
        transform: translateY(-2px);
    }

    .brand-title {
        text-align: center;
        font-weight: 700;
        color: #004aad;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }
    
    /* * Style untuk link "Kembali ke Login"
     */
    .login-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        text-decoration: none;
    }
    
    /* * Style untuk alert/pesan sukses
     */
    .alert.alert-reset {
        border-radius: 10px;
        border: 1px solid #badbcc;
        font-size: 0.95rem;
    }

</style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
<div class="reset-wrapper">
    
    {{-- Menggunakan kolom responsif yang sama --}}
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="card reset-card">
            <div class="brand-title">POS Me Time</div>
            <div class="card-header reset-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
                
                {{-- Style untuk alert sukses --}}
                @if (session('status'))
                    <div class="alert alert-success alert-reset" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- Email Field (diubah jadi layout vertikal) --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Tombol Submit (full-width) --}}
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary btn-reset">
                            {{ __('Kirim Link Reset Password') }}
                        </button>
                    </div>

                    {{-- Link Kembali ke Login (Tambahan) --}}
                    <a class="login-link" href="{{ route('login') }}">
                        {{ __('Kembali ke Login') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
