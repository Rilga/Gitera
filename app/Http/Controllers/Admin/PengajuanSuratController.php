<?php

namespace App\Http\Controllers\admin;

use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PengajuanSuratController extends Controller
{
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

    // SETUJUI
    public function approve($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = 'verified';
        $pengajuan->save();

        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    // TOLAK
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string'
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        $pengajuan->status = 'rejected';
        $pengajuan->notes = $request->alasan; // gunakan kolom notes

        $pengajuan->save();

        return back()->with('success', 'Pengajuan berhasil ditolak.');
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
