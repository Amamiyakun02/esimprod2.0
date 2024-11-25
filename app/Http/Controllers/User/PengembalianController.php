<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\DetailPengembalian;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class PengembalianController extends Controller
{
    public function index()
    {
        if(!session()->has('nomor_peminjaman')){
            return redirect('options');
        }

        $detailpeminjaman = DetailPeminjaman::where('kode_peminjaman', session()->get('nomor_peminjaman'))->get();
        $peminjaman = Peminjaman::where('kode_peminjaman', session()->get('nomor_peminjaman'))->first();
        $barang = [];
        foreach ($detailpeminjaman as $detail) {
            // Ambil data barang berdasarkan kode_barang
            $dataBarang = Barang::where('kode_barang', $detail->kode_barang)->first();

            if ($dataBarang) {
                $barang[] = [
                    'uuid' => $dataBarang->uuid,
                    'nama_barang' => $dataBarang->nama_barang,
                    'merk' => $dataBarang->merk,
                    'kode_barang' => $dataBarang->kode_barang,
                    'nomor_seri' => $dataBarang->nomor_seri,
                    'status' => $dataBarang->status,
                    // Tambahkan atribut lain sesuai kebutuhan
                ];
            }
        }
        $dataPeminjaman = [
            'nomor_peminjaman' => $peminjaman->nomor_surat,
            'tanggal_peminjaman' => $peminjaman->tanggal_peminjaman,
            'tanggal_kembali' => $peminjaman->tanggal_kembali,
            'peruntukan' => $peminjaman->peruntukan->uuid,
        ];
        session()->put('dataPeminjaman', $dataPeminjaman);
        session()->put('BarangData', $barang);
        return view('user.pengembalian.index', compact('peminjaman', 'barang'));
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_peminjaman' => 'required|exists:peminjaman,kode_peminjaman',
            'tanggal_kembali' => 'required|date',
            'petugas' => 'required|string|max:255',
            'peminjam' => 'required|string|max:255',
            'detail_barang' => 'required|array',
            'detail_barang.*.kode_barang' => 'required|exists:barang,kode_barang',
            'detail_barang.*.status' => 'required|in:baik,rusak,hilang',
        ]);

        // Simpan data Pengembalian
        $pengembalian = Pengembalian::create([
            'uuid' => Str::uuid(),
            'kode_pengembalian' => 'PG' . time(), // Bisa diubah sesuai format yang diinginkan
            'kode_peminjaman' => $validatedData['kode_peminjaman'],
            'tanggal_kembali' => $validatedData['tanggal_kembali'],
            'petugas' => $validatedData['petugas'],
            'peminjam' => $validatedData['peminjam'],
        ]);

        // Simpan data DetailPengembalian
        foreach ($validatedData['detail_barang'] as $barang) {
            DetailPengembalian::create([
                'uuid' => Str::uuid(),
                'kode_detail_pengembalian' => 'DPG' . Str::random(8), // Bisa diubah sesuai format
                'kode_pengembalian' => $pengembalian->kode_pengembalian,
                'kode_barang' => $barang['kode_barang'],
                'status' => $barang['status'],
            ]);
        }
    }
    public function validateItem(Request $request)
    {
        $request->validate([
            'itemCode' => 'required|string'
        ]);

        $itemCode = $request->itemCode;
        $dataPeminjaman = session()->get('BarangData', []);
        $isExist = collect($dataPeminjaman)->contains(function ($item) use ($itemCode) {
            return $item['kode_barang'] === $itemCode;
        });

        if ($isExist) {
            // Response jika kode ditemukan
            return response()->json([
                'success' => true,
                'message' => 'Kode ditemukan,Validasi Berhasil.',
            ], 200);
        }

        // Response jika kode tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Gagal Validasi.'
        ], 404);
    }
    public function report(Request $request)
    {

    }
    public function editDescription(Request $request){

    }
    public function print(Request $request)
    {

    }
}
