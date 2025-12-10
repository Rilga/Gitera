<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;

class UserController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $pengajuanAktif = PengajuanSurat::where('user_id', $userId)
        ->where('status', 'pending')
        ->count();

        $totalPengajuan = PengajuanSurat::where('user_id', $userId)
        ->count();

        $pengajuanTerbaru = PengajuanSurat::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

        return view('user.dashboard', compact(
            'pengajuanTerbaru',
            'pengajuanAktif',
            'totalPengajuan'
        ));
    }   
}
