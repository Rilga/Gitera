<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        return view('user.layanan');
    }

    public function kedatangan()
    {
        return view('user.layanan.kedatangan');
    }

    public function kelahiran()
    {
        return view('user.layanan.kelahiran');
    }

    public function kepindahan()
    {
        return view('user.layanan.kepindahan');
    }
}
