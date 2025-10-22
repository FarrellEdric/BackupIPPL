{{-- File: resources/views/auth/passwords/confirm.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
{{-- Link untuk Bootstrap Icons (Icon Mata) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /*
     * Kita gunakan style yang SAMA PERSIS dengan halaman login
     * Kita hanya ganti nama class utamanya
     */
    .confirm-wrapper {
        background: linear-gradient(135deg, #89f7fe, #66a6ff);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .card.confirm-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        padding: 1.5rem;
    }

    .card-header.confirm-header {
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

    .btn-primary.btn-confirm {
        background: #66a6ff;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%; /* Buat tombol full-width */
    }

    .btn-primary.btn-confirm:hover {
        background: #4a8efc;
        transform: translateY(-2px);
    }

    /* Style untuk wrapper password + icon mata */
    .password-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }

    .toggle-password:hover {
        color: #333;
    }

    .brand-title {
        text-align: center;
        font-weight: 700;
        color: #004aad;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }
    
    /* Style untuk link "Lupa Password" */
    .forgot-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        text-decoration: none;
    }

    /* Style untuk teks "Please confirm..." */
    .confirm-text {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #555;
    }
</style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
<div class="confirm-wrapper">
    
    {{-- Menggunakan kolom responsif yang sama dengan login --}}
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="card confirm-card">
            <div class="brand-title">POS Me Time</div>
            <div class="card-header confirm-header">{{ __('Confirm Password') }}</div>

            <div class="card-body">
                
                {{-- Teks intro kita pindah ke sini --}}
                <p class="confirm-text">{{ __('Please confirm your password before continuing.') }}</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    {{-- Password Field (diubah jadi layout vertikal + icon) --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="password-wrapper">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password">
                            {{-- Kita tambahkan icon mata di sini --}}
                            <i class="toggle-password bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Tombol Konfirmasi --}}
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary btn-confirm">
                            {{ __('Confirm Password') }}
                        </button>
                    </div>

                    {{-- Link Lupa Password --}}
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 3. SCRIPTS (JAVASCRIPT) KHUSUS HALAMAN INI --}}
@push('scripts')
{{-- Kita butuh script ini untuk icon mata --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        }
    });
</script>
@endpush