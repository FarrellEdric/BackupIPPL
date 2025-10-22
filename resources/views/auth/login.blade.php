{{-- File: resources/views/auth/login.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
    {{-- Link untuk Bootstrap Icons (Icon Mata) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* * Kita pindahkan background dan font ke .login-container
         * agar tidak mempengaruhi halaman lain yang pakai layout sama.
         */
        .login-wrapper {
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            /* Diubah dari height ke min-height */
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 2rem;
            /* Tambahan padding atas */
            padding-bottom: 2rem;
            /* Tambahan padding bawah */
        }

        .card.login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
            /* Tambahan padding di dalam card */
        }

        .card-header.login-header {
            background: transparent;
            border: none;
            text-align: center;
            font-weight: 600;
            font-size: 1.8rem;
            color: #333;
            padding-top: 0;
            /* Rapikan padding header */
            padding-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #66a6ff;
            box-shadow: 0 0 8px rgba(102, 166, 255, 0.3);
        }

        .btn-primary.btn-login {
            background: #66a6ff;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            /* Buat tombol login full-width */
        }

        .btn-primary.btn-login:hover {
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
            /* Penyesuaian posisi agar pas dengan input */
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
            /* Sesuaikan ukuran font brand */
        }

        .forgot-password-link {
            display: block;
            /* Buat link lupa password jadi block */
            text-align: center;
            /* Posisikan di tengah */
            margin-top: 1rem;
            /* Beri jarak dari tombol login */
        }
    </style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
    {{-- 
  Wrapper ini sekarang yang memegang background gradient.
  Kita juga hapus class "container" agar bisa full-width.
--}}
    <div class="login-wrapper">

        {{-- 
      Ini adalah kelas kolom responsif yang baru.
      - col-11: 91% lebar di HP (xs)
      - col-sm-10: 83% lebar di HP (sm)
      - col-md-8: 66% lebar di tablet (md)
      - col-lg-6: 50% lebar di desktop (lg)
      - col-xl-5: 41% lebar di desktop besar (xl)
      
      Ini membuat card login tidak terlalu besar di desktop
      dan tidak terlalu sempit (atau mentok) di HP.
    --}}
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <div class="card login-card">
                <div class="brand-title"> POS Me Time</div>
                <div class="card-header login-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- 1. Label kita taruh di LUAR wrapper --}}
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            {{-- 2. Wrapper ini SEKARANG HANYA membungkus input dan icon --}}
                            <div class="password-wrapper">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required>

                                {{-- Icon ini sekarang akan center sempurna di dalam wrapper --}}
                                <i class="toggle-password bi bi-eye-slash" id="togglePassword"></i>
                            </div>

                            {{-- 3. Error message kita taruh di LUAR wrapper --}}
                            @error('password')
                                {{-- Tambahkan class 'd-block' agar pesan error tetap muncul --}}
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary btn-login">
                                {{ __('Login') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="text-decoration-none forgot-password-link" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                        {{-- belum punya akun? --}}
                            <a class="text-decoration-none forgot-password-link" href="{{ route('register') }}">
                                {{ __("Belum punya akun? Daftar di sini") }}
                            </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- 3. SCRIPTS (JAVASCRIPT) KHUSUS HALAMAN INI --}}
@push('scripts')
    <script>
        // Pastikan DOM sudah siap
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    // Toggle tipe input
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // Toggle ikon mata
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
@endpush
