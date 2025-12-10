<?php

namespace App\Http\Controllers\admin;

use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\WhatsappTrait;
use PDF;

class PengajuanSuratController extends Controller
{
    use WhatsappTrait;
    // LIST DATA
    public function index(Request $request)
    {
        $query = PengajuanSurat::query();

        // Filter tanggal
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by nama & jenis surat
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                ->orWhere('slug', 'like', "%{$request->search}%")
                ->orWhere('data->nama', 'like', "%{$request->search}%");
            });
        }

        $pengajuans = $query->latest()->paginate(20);

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    // DETAIL
    public function show($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    // --- FUNGSI SETUJUI (APPROVE) DENGAN NOTIFIKASI BARU ---
    public function approve($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        // Cek apakah status sudah verified
        if ($pengajuan->status == 'verified') {
            return back()->with('warning', 'Pengajuan sudah disetujui sebelumnya.');
        }

        $pengajuan->status = 'verified';
        $pengajuan->save();

        // KIRIM NOTIFIKASI WHATSAPP UNTUK DISETUJUI
        $no_hp = $pengajuan->user->no_hp ?? null; 
        $nama = $pengajuan->user->name ?? 'Pemohon';
        $jenis_surat = $pengajuan->title;

        if ($no_hp) {
            // PESAN NOTIFIKASI BARU (tanpa link download)
            $pesan = "Halo *$nama*,\n\nPengajuan surat Anda (*$jenis_surat*) telah *DISETUJUI*.\n\nAnda dapat mengambil surat yang sudah ditandatangani di **Kantor Desa** pada jam kerja.\n\nTerima kasih atas penggunaan layanan ini.";
            $this->sendWhatsappNotification($no_hp, $pesan);
        }

        return back()->with('success', 'Pengajuan berhasil disetujui. Notifikasi WhatsApp telah dikirim.');
    }

    // --- FUNGSI TOLAK (REJECT) DENGAN NOTIFIKASI BARU ---
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string'
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);
        
        // Cek apakah status sudah rejected
        if ($pengajuan->status == 'rejected') {
            return back()->with('warning', 'Pengajuan sudah ditolak sebelumnya.');
        }

        $pengajuan->status = 'rejected';
        $pengajuan->notes = $request->alasan; // gunakan kolom notes

        $pengajuan->save();

        // KIRIM NOTIFIKASI WHATSAPP UNTUK DITOLAK
        $no_hp = $pengajuan->user->no_hp ?? null; 
        $nama = $pengajuan->user->name ?? 'Pemohon';
        $jenis_surat = $pengajuan->title;
        $alasan_tolak = $request->alasan;

        if ($no_hp) {
            // PESAN NOTIFIKASI BARU
            $pesan = "Halo *$nama*,\n\nMohon maaf, pengajuan surat Anda (*$jenis_surat*) telah *DITOLAK*.\n\nAlasan penolakan: *$alasan_tolak*.\n\nMohon untuk **memperbaiki data** dan mengajukan kembali.";
            $this->sendWhatsappNotification($no_hp, $pesan);
        }

        return back()->with('success', 'Pengajuan berhasil ditolak. Notifikasi WhatsApp telah dikirim.');
    }

    // DOWNLOAD SURAT PDF
    public function download($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        // Gunakan slug sebagai nama file PDF
        $slug = $pengajuan->slug;

        // Lokasi template PDF mengikuti folder user
        $view = "user.layanansurat.pdf.$slug";

        if (!view()->exists($view)) {
            abort(404, "Template PDF untuk surat ($slug) belum dibuat.");
        }

        $pdf = PDF::loadView($view, [
            'pengajuan' => $pengajuan,
            'data' => $pengajuan->data,
            'files' => $pengajuan->files,
            'title' => $pengajuan->title,
        ])->setPaper('a4', 'portrait');

        return $pdf->download("surat-$slug-{$pengajuan->id}.pdf");
    }
}
