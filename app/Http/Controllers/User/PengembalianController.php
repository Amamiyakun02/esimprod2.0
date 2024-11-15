<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjamann;
use App\Models\Pengembalian;
use App\Models\Barang;
class PengembalianController extends Controller
{
    public function index()
    {

        return;
    }

    public function checkPeminjaman(Request $request)
    {
        // Validasi input code
        $request->validate([
            'code' => 'required|string'
        ]);
    
        // Kode peminjaman yang valid
        $validCode = "SDFDSGDS";
    
        // Pengecekan apakah code input sesuai dengan kode peminjaman yang valid
        if ($request->code === $validCode) {
            // Redirect ke route pengembalian jika berhasil
            return redirect()->route('user.pengembalian.index')->with('success', 'Kode ditemukan, silakan lakukan pengembalian.');
        }
    
        // Jika kode tidak cocok, kembali ke halaman sebelumnya dengan pesan error
        return back()->withErrors(['code' => 'Kode tidak ditemukan.']);
    }
    

    public function confirmPengembalian()
    {
        return;
    }
}
