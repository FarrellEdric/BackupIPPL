{{-- File: resources/views/auth/passwords/reset.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
{{-- Link untuk Bootstrap Icons (Icon Mata) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /*
     * Style ini sama persis dengan halaman Register
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

    .form-control,
    .form-select { /* Ambil dari style register */
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus { /* Ambil dari style register */
        border-color: #66a6ff;
        box-shadow: 0 0 8px rgba(102, 166, 255, 0.3);
    }

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
</style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
<div class="reset-wrapper">
    
    {{-- Menggunakan kolom responsif yang sama dengan login --}}
    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="card reset-card">
            <div class="brand-title">POS Me Time</div>
            <div class="card-header reset-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    {{-- Token (wajib ada) --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email Address --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="password-wrapper">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            <i class="toggle-password bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <div class="password-wrapper">
                            <input id="password-confirm" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                            <i class="toggle-password bi bi-eye-slash" id="togglePasswordConfirm"></i>
                        </div>
                    </div>

                    {{-- Tombol Reset --}}
                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary btn-reset">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 3. SCRIPTS (JAVASCRIPT) KHUSUS HALAMAN INI --}}
@push('scripts')
{{-- Kita pakai script yang sama dengan halaman Register untuk 2 icon mata --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- Logic untuk Toggle Password Pertama ---
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

        // --- Logic untuk Toggle Password Kedua (Konfirmasi) ---
        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password-confirm');

        if (togglePasswordConfirm) {
            togglePasswordConfirm.addEventListener('click', function () {
                const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirm.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        }

    });
</script>
@endpush