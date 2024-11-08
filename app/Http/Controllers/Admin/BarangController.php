<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\JenisBarang;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Barang',
            'barang' => Barang::simplePaginate(5),
            'count' => Barang::count()
        ];

        return view('admin.barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Barang',
            'jenis_barang' => JenisBarang::all()
        ];

        return view('admin.barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required|exists:jenis_barang,kode_jenis_barang',
            'status' => 'required',
            'limit' => 'required|numeric',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'jenis_barang_id.required' => 'Jenis Barang wajib diisi.',
            'jenis_barang_id.exists' => 'Jenis barang tidak ditemukan.',
            'status.required' => 'Status wajib diisi.',
            'limit.required' => 'Limit wajib diisi.',
            'limit.numeric' => 'Limit harus berupa angka.',
            'foto.mimes' => 'File harus dalam format jpg, jpeg, png.',
            'foto.max' => 'Ukuran file maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uuid = Str::random(16);
        $kode_barang = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 12);
        $qrCode = QrCode::format('png')->size(200)->generate($kode_barang);
        $qrCodeFileName = time() . '_qr.png';
        Storage::disk('public')->put('uploads/qr_codes/' . $qrCodeFileName, $qrCode);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $randomName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/foto_barang', $randomName, 'public');
            $data['foto'] = $randomName;
        } else {
            $data['foto'] = 'default.jpg';
        }

        Barang::create([
            'uuid' => $uuid,
            'kode_barang' => $kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang_id' => $request->jenis_barang_id,
            'status' => $request->status,
            'limit' => $request->limit,
            'sisa_limit' => $request->limit,
            'foto' => $data['foto'],
            'deskripsi' => $request->deskripsi,
            'qr_code' => $qrCodeFileName,
        ]);

        notify()->success('Barang Berhasil Ditambahkan');
        return redirect()->route('barang.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => Barang::where('uuid', $uuid)->first(),
        ];

        return view('admin.barang.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $data = [
            'title' => 'Edit Barang',
            'barang' => Barang::where('uuid', $uuid)->first(),
            'jenis_barang' => JenisBarang::all()
        ];

        return view('admin.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required|exists:jenis_barang,kode_jenis_barang',
            'status' => 'required',
            'limit' => 'required|numeric',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'jenis_barang_id.required' => 'Jenis Barang wajib diisi.',
            'jenis_barang_id.exists' => 'Jenis barang tidak ditemukan.',
            'status.required' => 'Status wajib diisi.',
            'limit.required' => 'Limit wajib diisi.',
            'limit.numeric' => 'Limit harus berupa angka.',
            'foto.mimes' => 'File harus dalam format jpg, jpeg, png.',
            'foto.max' => 'Ukuran file maksimal adalah 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang = Barang::where('uuid', $uuid)->first();

        if (!$barang) {
            emotify('error', 'Barang tidak ditemukan');
            return redirect()->back();
        }

        $randomName = $barang->foto;
        if ($request->hasFile('foto')) {
            if ($barang->foto && $barang->foto !== 'default.jpg') {
                Storage::disk('public')->delete('uploads/foto_barang/' . $barang->foto);
            }

            $file = $request->file('foto');
            $randomName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/foto_barang', $randomName, 'public');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jenis_barang_id' => $request->jenis_barang_id,
            'status' => $request->status,
            'limit' => $request->limit,
            'sisa_limit' => $request->limit,
            'deskripsi' => $request->deskripsi,
            'foto' => $randomName,
        ]);

        notify()->success('Barang Berhasil Diupdate');
        return redirect()->route('barang.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $barang = Barang::where('uuid', $uuid)->first();
        if ($barang) {
            if ($barang->qr_code) {
                Storage::disk('public')->delete('uploads/qr_codes/' . $barang->qr_code);
            }

            if ($barang->foto && $barang->foto !== 'default.jpg') {
                Storage::disk('public')->delete('uploads/foto_barang/' . $barang->foto);
            }

            $barang->delete();
            notify()->success('Barang Berhasil Dihapus');
            return redirect()->route('barang.index');
        }
    }

    public function resetLimit(string $uuid)
    {
        $barang = Barang::where('uuid', $uuid)->first();
        if ($barang) {
            if ($barang->sisa_limit == $barang->limit) {
                notify()->warning('Barang sudah direset sebelumnya');
                return redirect()->back();
            }

            $barang->update([
                'sisa_limit' => $barang->limit
            ]);
            notify()->success('Limit Berhasil Direset');
            return redirect()->back();
        }
    }


    public function printBarang()
    {
        $data['barang'] = Barang::all();

        if ($data['barang']->isEmpty()) {
            emotify('error', 'Barang tidak ditemukan');
            return redirect()->back();
        }

        $pdf = Pdf::loadView('admin.barang.barang_pdf', $data)->setPaper('a4', 'potrait');
        return $pdf->download('Barang-' . time() . '.pdf');
    }

    public function printQrCode()
    {
        $data['barang'] = Barang::all();

        if ($data['barang']->isEmpty()) {
            emotify('error', 'Barang tidak ditemukan');
            return redirect()->back();
        }

        $pdf = Pdf::loadView('admin.barang.qrcode_pdf', $data)->setPaper('a4', 'potrait');
        return $pdf->download('QRCode-Barang-' . time() . '.pdf');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $barang = Barang::where('nama_barang', 'like', '%' . $search . '%')
            ->orWhereHas('jenisBarang', function ($q) use ($search) {
                $q->where('jenis_barang', 'like', '%' . $search . '%');
            })->simplePaginate(5);

        $data = [
            'title' => 'Barang',
            'barang' => $barang,
            'count' => Barang::count()
        ];

        return view('admin.barang.index', $data);
    }

    public function jenisBarang(JenisBarang $jenisBarang)
    {
        $barang = $jenisBarang->barang()->with('jenisBarang')->simplePaginate(5);

        $data = [
            'title' => 'Jenis Barang : ' . $jenisBarang->jenis_barang,
            'barang' => $barang
        ];
        return view('admin.barang.index', $data);
    }
}
