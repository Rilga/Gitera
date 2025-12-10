<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // --- 1. Statistik Atas ---

        // Hitung user dengan role 'user' dan status 'pending'
        $totalAkunPending = User::where('role', 'user')
                                ->where('status', 'pending')
                                ->count();

        // Total seluruh user warga
        $totalAkun = User::where('role', 'user')->count();
        
        // Surat baru (status pending)
        $suratBaru = PengajuanSurat::where('status', 'pending')->count();
        
        // Total seluruh surat masuk
        $suratTotal = PengajuanSurat::count();
        
        // Surat Keluar (Diasumsikan status 'verified' artinya surat sudah jadi/disetujui)
        $suratKeluar = PengajuanSurat::where('status', 'verified')->count();
        
        // Dummy kenaikan (bisa diganti logic real jika ada data bulan lalu)
        $kenaikanSurat = 15; 

        // --- 2. Tabel Pengajuan Surat Masuk (Kiri Bawah) ---
        // Relasi 'user' harus didefinisikan di model PengajuanSurat
        $recentSurats = PengajuanSurat::with('user')
                                    ->latest() // Order by created_at desc
                                    ->take(5)
                                    ->get();

        // --- 3. List Pengajuan Akun (Kanan Bawah - Sidebar) ---
        $recentAccounts = User::where('role', 'user')
                            ->where('status', 'pending') // Fokus menampilkan yang pending saja agar admin notice
                            ->latest()
                            ->take(7)
                            ->get();

        return view('admin.dashboard', compact(
            'totalAkunPending', 'totalAkun', 
            'suratBaru', 'suratTotal', 'suratKeluar', 'kenaikanSurat',
            'recentSurats', 'recentAccounts'
        ));
    }

    // Method untuk menampilkan halaman daftar verifikasi
    public function showVerificationList(Request $request)
    {
        $search = $request->query('search');

        // Ambil semua user dengan role 'user' dan status 'pending'
        $pendingUsers = User::where('role', 'user')
            ->where('status', 'pending')
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil user yang approved (Warga Aktif)
        $users = User::where('role', 'user')
            ->where('status', 'approved')
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
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
