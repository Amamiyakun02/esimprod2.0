<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Barang;
class PengembalianController extends Controller
{
    public function index()
    {
        return view('user.pengembalian.index');
    }

    public function checkPeminjaman(Request $request)
    {
    $request->validate([
        'code' => 'required|string'
    ]);

    // Cari kode peminjaman di database
    $peminjaman = Peminjaman::where('kode_peminjaman', $request->code)->first();

    if ($peminjaman) {
        // Response jika kode ditemukan
        return response()->json([
            'success' => true,
            'message' => 'Kode ditemukan, silakan lakukan pengembalian.',
            'redirect_url' => route('user.pengembalian.index')
        ], 200);
    }

    // Response jika kode tidak ditemukan
    return response()->json([
        'success' => false,
        'message' => 'Kode tidak ditemukan.'
    ], 404);
}


    public function confirmPengembalian()
    {
        return;
    }
}
