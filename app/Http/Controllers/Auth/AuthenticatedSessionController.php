<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // 1. Cek Admin
        if ($user->role == 'admin') {
            return redirect(route('admin.dashboard'));
        }

        // 2. Cek User
        if ($user->role == 'user') {
            // Cek jika status sudah disetujui
            if ($user->status == 'approved') {
                return redirect()->intended(route('user.dashboard', absolute: false));
            } else {
                // Jika status 'pending' atau 'rejected', paksa logout
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Kirim pesan error spesifik berdasarkan status
                $errorMessage = $user->status == 'pending'
                    ? 'Akun Anda sedang menunggu verifikasi admin.'
                    : 'Akun Anda ditolak atau diblokir.';

                return redirect(route('login'))->withErrors(['email' => $errorMessage]);
            }
        }

        // 3. Jika role tidak terdefinisi (Fallback)
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->withErrors(['email' => 'Role tidak valid.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
