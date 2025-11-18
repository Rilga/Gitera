<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['required', 'string', 'digits:16', 'unique:'.User::class], // Validasi NIK 16 digit & unik
            'no_hp' => ['required', 'string', 'max:15'], // Validasi No. HP
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'user',       // Set role default ke 'user'
            'status' => 'pending',  // Set status default ke 'pending'
        ]);

        event(new Registered($user));

        // HAPUS BARIS Auth::login($user);
        // Kita tidak ingin user langsung login

        // Arahkan ke halaman login dengan pesan
        return redirect(route('login'))->with('status', 'Registrasi berhasil! Silakan tunggu verifikasi admin.');
    }
}
