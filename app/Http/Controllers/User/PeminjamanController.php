<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;



class PeminjamanController extends Controller
{
    
    public function index()
    {
        $borrowedItems = session()->get('borrowed_items', []);
        // session()->forget('borrowed_items');
        return view('user.peminjaman.index', compact('borrowedItems'));
    }


    public function scan(Request $request)
    {
        $validatedData = $request->validate([
            'qrcode' => 'required|string|max:50',
        ]);
        
        \Log::info("Scanned itemcode:", $validatedData);
    
        // Ambil item berdasarkan QR code dari database
        $item = $this->findItemByQrcode($validatedData['qrcode']);
    
        // Ambil daftar item yang sudah dipindai dari session
        $borrowedItems = session()->get('borrowed_items', []);
    
        // Cek apakah item sudah ada di session
        if ($item && collect($borrowedItems)->contains('uuid', $item->uuid)) {
            // Jika item sudah ada, kirimkan response error
            return response()->json([
                'success' => false,
                'message' => 'Item sudah dipindai sebelumnya.',
            ], 400);
        }
    
        $response = [
            'success' => !!$item,
            'message' => $item ? 'Barang Telah Ditambahkan.' : 'Barang Tidak Tersedia.',
        ];
    
        if ($item) {
            // Siapkan data item
            $itemData = [
                'uuid' => $item->uuid,
                'name' => $item->nama_barang,
                'merk' => $item->merk,
                'serial_number' => $item->nomor_seri,
                'timestamp' => now()->timestamp // Menambahkan timestamp untuk tracking
            ];
    
            // Tambahkan item baru ke array borrowed_items
            $borrowedItems[] = $itemData;
    
            // Simpan array updated borrowed_items ke session
            session()->put('borrowed_items', $borrowedItems);
            
            $response['item'] = $itemData;
        }
    
        return response()->json($response, 200);
    }
    
    protected function findItemByQrcode(string $qrcode)
    {
        return Barang::where('kode_barang', $qrcode)->first(); // Replace with your logic
    }

    // public function saveBorrowing(Request $request)
    // {
    //     $borrowedItems = session()->get('borrowed_items', []);
        
    //     if (empty($borrowedItems)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No items to borrow'
    //         ], 400);
    //     }
        
    //     try {
    //         \DB::beginTransaction();
            
    //         // Create borrowing record
    //         $borrowing = Peminjaman::create([
    //             'user_id' => auth()->id(),
    //             'assignment_letter' => $request->assignment_letter,
    //             'borrow_date' => now(),
    //             'status' => 'borrowed'
    //         ]);
            
    //         // Create borrowing details
    //         foreach ($borrowedItems as $item) {
    //             BorrowingDetail::create([
    //                 'borrowing_id' => $borrowing->id,
    //                 'item_id' => $item['id']
    //             ]);
                
    //             // Update item availability
    //             Item::where('id', $item['id'])->update(['is_available' => false]);
    //         }
            
    //         // Clear session
    //         session()->forget('borrowed_items');
            
    //         \DB::commit();
            
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Borrowing saved successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         \DB::rollback();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error saving borrowing: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function removeItem($uuid)
    {
        // Ambil data 'borrowed_items' dari session
        $borrowedItems = session()->get('borrowed_items', []);
    
        // Cari index item berdasarkan 'uuid' dan hapus jika ditemukan
        $borrowedItems = array_filter($borrowedItems, function($item) use ($uuid) {
            return $item['uuid'] !== $uuid;
        });
    
        // Simpan kembali ke session
        session()->put('borrowed_items', array_values($borrowedItems));
    
        // Kembalikan respons JSON untuk AJAX
        return response()->json(['success' => true, 'message' => 'Item berhasil dihapus']);
    }

    public function laporan(){
        return view('user.laporan.index');
    }

    public function printDocs()
    {
        $data = [];
        $pdf = Pdf::loadView('user.laporan.index', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-peminjaman' . time() . '.pdf');
    }
}
