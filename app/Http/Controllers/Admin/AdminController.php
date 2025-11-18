<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Method untuk menampilkan halaman daftar verifikasi
    public function showVerificationList()
    {
        // Ambil semua user dengan role 'user' dan status 'pending'
        $pendingUsers = User::where('role', 'user')
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();
    
        // Ambil user yang approved (Warga Aktif)
        $users = User::where('role', 'user')
                    ->where('status', 'approved')
                    ->orderBy('name', 'asc')
                    ->get();

        // Tampilkan view dan kirim datanya
        return view('admin.verification-list', compact('pendingUsers', 'users'));
    }

    // Method untuk memproses persetujuan
    public function approveUser(User $user)
    {
        // Update status user menjadi 'approved'
        $user->status = 'approved';
        $user->save();

        // (Opsional) Kirim email notifikasi ke user bahwa akunnya sudah aktif

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'User ' . $user->name . ' telah disetujui.');
    }

    public function rejectUser(User $user)
    {
        // Keamanan ekstra: pastikan hanya user 'pending' yang bisa dihapus lewat jalur ini
        if ($user->status === 'pending') {
            $userName = $user->name;
            $user->delete(); // Hapus user dari database

            return redirect()->back()->with('success', 'User ' . $userName . ' telah ditolak dan dihapus.');
        }

        return redirect()->back()->with('error', 'Hanya user pending yang bisa ditolak.');
    }

    /**
     * Menghapus user aktif (Misalnya jika pindah rumah atau meninggal).
     */
    public function destroyUser(User $user)
    {
        $name = $user->name;
        $user->delete();
        return redirect()->back()->with('success', 'Data warga atas nama ' . $name . ' berhasil dihapus.');
    }
}
