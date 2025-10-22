{{-- File: resources/views/auth/register.blade.php --}}

{{-- 1. STYLES (CSS) KHUSUS HALAMAN INI --}}
@push('styles')
    {{-- Link untuk Bootstrap Icons (Icon Mata) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /*
                 * Kita gunakan style yang SAMA PERSIS dengan halaman login
                 * Cukup ganti nama class utamanya ke .register-wrapper
                 */
        .register-wrapper {
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card.register-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
        }

        .card-header.register-header {
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
        .form-select {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 8px rgba(102, 166, 255, 0.3);
        }

        .btn-primary.btn-register {
            background: #66a6ff;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            /* Buat tombol full-width */
        }

        .btn-primary.btn-register:hover {
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

        .login-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            text-decoration: none;
        }

        /* * CSS untuk Custom Dropdown
         */
        .custom-dropdown-wrapper {
            position: relative;
            cursor: pointer;
        }

        /* * Kita beri style trigger-nya agar mirip
         * dengan .form-select yang sudah ada
         */
        .custom-dropdown-trigger {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Ambil style dari .form-select */
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        /* * Ini adalah kotak opsinya. Tersembunyi by default.
         */
        .custom-dropdown-options {
            display: none;
            /* Sembunyi */
            position: absolute;
            top: 100%;
            /* Muncul tepat di bawah trigger */
            left: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 4px;
            /* Jarak sedikit */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
            max-height: 200px;
            overflow-y: auto;
        }

        /* * Kelas 'show' ini akan ditambahkan oleh JavaScript
         * untuk memunculkan kotak opsi
         */
        .custom-dropdown-options.show {
            display: block;
        }

        /* * Ini adalah style per opsi
         */
        .custom-dropdown-option {
            padding: 10px 15px;
            transition: background-color 0.2s ease;
        }

        /* * Ini style saat di-hover
         */
        .custom-dropdown-option:hover {
            background-color: #f0f4ff;
            /* Warna hover biru muda */
        }
    </style>
@endpush

{{-- 2. KONTEN UTAMA (HTML) --}}
@extends('layouts.app')

@section('content')
    <div class="register-wrapper">

        {{-- Menggunakan kolom responsif yang sama dengan login --}}
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <div class="card register-card">
                <div class="brand-title">POS Me Time</div>
                <div class="card-header register-header">{{ __('Register Akun Baru') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email Address --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}</label>

                            {{-- Input tersembunyi untuk menyimpan nilai role yang dipilih --}}
                            <input type="hidden" name="role" id="role-value" value="{{ old('role') }}">

                            {{-- Ini wrapper untuk dropdown palsu kita --}}
                            <div class="custom-dropdown-wrapper">
                                <div class="custom-dropdown-trigger form-select @error('role') is-invalid @enderror"
                                    id="role-trigger">
                                    {{-- Teks ini akan diisi oleh JavaScript --}}
                                    <span id="role-trigger-text">Pilih Role Anda...</span>
                                </div>
                                <div class="custom-dropdown-options" id="role-options">
                                    <div class="custom-dropdown-option" data-value="admin">Onwer</div>
                                    <div class="custom-dropdown-option" data-value="kasir">Kasir</div>
                                </div>
                            </div>

                            {{-- Pesan error tetap sama --}}
                            @error('role')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="password-wrapper">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
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
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                {{-- 
                              Kita beri ID unik untuk toggle konfirmasi password 
                            --}}
                                <i class="toggle-password bi bi-eye-slash" id="togglePasswordConfirm"></i>
                            </div>
                        </div>

                        {{-- Tombol Register --}}
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary btn-register">
                                {{ __('Register') }}
                            </button>
                        </div>

                        {{-- Link ke Login --}}
                        <a class="login-link" href="{{ route('login') }}">
                            {{ __('Sudah punya akun? Login di sini') }}
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
        document.addEventListener('DOMContentLoaded', function() {

            // --- Logic untuk Toggle Password Pertama ---
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
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
                togglePasswordConfirm.addEventListener('click', function() {
                    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordConfirm.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }

            /* =====================================
            == LOGIC UNTUK CUSTOM DROPDOWN ROLE ==
            =====================================
            */
            const wrapper = document.querySelector('.custom-dropdown-wrapper');
            const trigger = document.querySelector('#role-trigger');
            const triggerText = document.querySelector('#role-trigger-text');
            const optionsContainer = document.querySelector('#role-options');
            const allOptions = document.querySelectorAll('.custom-dropdown-option');
            const hiddenInput = document.querySelector('#role-value');

            // 1. Logika untuk memuat nilai 'old' saat halaman refresh
            const oldRoleValue = hiddenInput.value;
            if (oldRoleValue) {
                allOptions.forEach(option => {
                    if (option.getAttribute('data-value') === oldRoleValue) {
                        triggerText.textContent = option.textContent;
                    }
                });
            } else {
                // Jika tidak ada 'old', set default text
                triggerText.textContent = 'Pilih Role Anda...';
            }

            // 2. Logika untuk Buka/Tutup dropdown
            if (trigger) {
                trigger.addEventListener('click', function() {
                    // Toggle (buka/tutup) list opsi
                    optionsContainer.classList.toggle('show');
                });
            }

            // 3. Logika saat salah satu Opsi dipilih
            allOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.textContent;

                    // Set nilai ke input tersembunyi (ini yang dikirim)
                    hiddenInput.value = value;

                    // Set teks di kotak trigger
                    triggerText.textContent = text;

                    // Tutup dropdown
                    optionsContainer.classList.remove('show');
                });
            });

            // 4. Logika untuk menutup dropdown jika klik di luar
            window.addEventListener('click', function(e) {
                if (wrapper && !wrapper.contains(e.target)) {
                    // Jika klik di luar '.custom-dropdown-wrapper'
                    optionsContainer.classList.remove('show');
                }
            });
        });
    </script>
@endpush
