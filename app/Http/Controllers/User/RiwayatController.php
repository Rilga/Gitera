<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Query dasar
        $query = PengajuanSurat::where('user_id', $user->id);

        // Filter pencarian (ID atau title)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($qur) use ($q) {
                $qur->where('slug', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%");
            });
        }

        // Filter status (Selesai / Diproses / Ditolak)
        $statusMap = [
            'Selesai' => 'verified',
            'Diproses' => 'pending',
            'Ditolak' => 'rejected',
        ];

        if ($request->filled('status') && isset($statusMap[$request->status])) {
            $query->where('status', $statusMap[$request->status]);
        }

        // Ambil data dengan pagination
        $surats = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Hitung summary
        $total = PengajuanSurat::where('user_id', $user->id)->count();
        $selesai = PengajuanSurat::where('user_id', $user->id)->where('status', 'verified')->count();
        $diproses = PengajuanSurat::where('user_id', $user->id)->where('status', 'pending')->count();
        $ditolak = PengajuanSurat::where('user_id', $user->id)->where('status', 'rejected')->count();

        return view('user.riwayat.index', compact(
            'surats', 'total', 'selesai', 'diproses', 'ditolak'
        ));
    }

    public function show($id)
    {
        $surat = PengajuanSurat::findOrFail($id);

        // Mapping status untuk tampilan
        $statusMap = [
            'pending' => ['label' => 'Diproses', 'color' => 'blue'],
            'verified' => ['label' => 'Selesai', 'color' => 'green'],
            'rejected' => ['label' => 'Ditolak', 'color' => 'red'],
        ];
        $status = $statusMap[$surat->status] ?? ['label' => 'Unknown', 'color' => 'gray'];

        return view('user.riwayat.show', compact('surat', 'status'));
    }

    public function download($id)
    {
        $surat = PengajuanSurat::findOrFail($id);

        if ($surat->status !== 'verified') {
            abort(403, 'File hanya bisa diunduh jika status Selesai.');
        }

        $files = json_decode($surat->files, true) ?? [];

        if (empty($files)) {
            abort(404, 'Tidak ada file untuk diunduh.');
        }

        // Untuk contoh: download file pertama
        $file = $files[0];
        return response()->download(storage_path('app/' . $file['path']), $file['original_name']);
    }
}
