<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tentukan ke mana user diarahkan setelah login.
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Cek apakah user valid dan punya role
        if (!$user || !isset($user->role)) {
            Auth::logout();
            return '/login';
        }

        // Arahkan sesuai role user
        if ($user->role === 'owner') {
            return '/dashboard';
        }

        if ($user->role === 'kasir') {
            return '/kasir/dashboard';
        }

        // Jika role tidak dikenali, logout
        Auth::logout();
        return '/login';
    }

    /**
     * Constructor untuk middleware.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
