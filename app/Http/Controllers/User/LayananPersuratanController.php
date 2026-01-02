<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;
use PDF; // barryvdh/laravel-dompdf

class LayananPersuratanController extends Controller
{
    protected $layananList = [
        'kepindahan' => 'Kepindahan',
        'kedatangan' => 'Kedatangan',
        'kelahiran' => 'Akta Kelahiran',
        'kematian' => 'Akta Kematian',
        'domisili' => 'Surat Keterangan Domisili',
        'usaha' => 'Surat Keterangan Usaha',
        'sktm' => 'Surat Keterangan Tidak Mampu',
        'penghasilan' => 'Surat Keterangan Penghasilan',
        'ktp-sementara' => 'Surat Keterangan KTP Sementara',
        'domisili-usaha' => 'Surat Keterangan Domisili Usaha',
        'skck' => 'Pengantar Permohonan SKCK',
    ];

    public function index()
    {
        $userId = auth()->id();

        $list = PengajuanSurat::where('user_id', $userId)
            ->latest()
            ->paginate(10);

        return view('user.listlayanan', compact('list'));
    }

    public function show($slug)
    {
        if (!array_key_exists($slug, $this->layananList)) {
            abort(404);
        }

        $title = $this->layananList[$slug];

        return view("user.layanansurat.forms.$slug", compact('slug', 'title'));
    }

    public function store(Request $request, $slug)
    {
        if (!array_key_exists($slug, $this->layananList)) {
            abort(404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,zip,rar|max:51200',
        ]);

        $userId = auth()->id();

        $storedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = $file->store("pengajuan/$slug/$userId", 'public');

                $storedFiles[] = [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getClientMimeType(),
                ];
            } 
        }

        $formData = $request->except(['_token', 'files']);

        PengajuanSurat::create([
            'user_id'  => $userId,
            'slug'     => $slug,
            'title'    => $this->layananList[$slug],
            'data'     => $formData,
            'files'    => $storedFiles,
            'status'   => 'pending',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan berhasil dikirim.');
    }

    // ========================
    //       DOWNLOAD PDF
    // ========================
    public function downloadPdf($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        // Hanya admin atau pemilik
        if (!auth()->user()->is_admin && $pengajuan->user_id !== auth()->id()) {
            abort(403);
        }

        $viewHtml = view("user.layanansurat.pdf." . $pengajuan->slug, [
            'pengajuan' => $pengajuan,
            'data'      => $pengajuan->data,
            'files'     => $pengajuan->files,
            'title'     => $pengajuan->title,
        ])->render();

        $pdf = PDF::loadHTML($viewHtml)->setPaper('a4', 'portrait');

        return $pdf->download($pengajuan->slug . '-' . $pengajuan->id . '.pdf');
    }
}
