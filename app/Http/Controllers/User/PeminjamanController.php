<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $borrowedItems = session()->get('borrowed_items', []);
        return view('user.peminjaman.index', compact('borrowedItems'));
    }
    
    public function scanBarcode(Request $request)
    {
        // Validasi inputapplication
        $request->validate([
            'barcode' => 'required|string'
        ]);

        $barcode = $request->barcode;

        // Cari item berdasarkan barcode
        $item = Barang::where('kode_barang', $barcode)->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
                'code' => $barcode
            ], 404);
        }

        // Periksa apakah item tersedia
        if (!$item->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'Item is not available for borrowing'
            ], 400);
        }

        // Ambil daftar item yang dipinjam dari sesi
        $borrowedItems = session()->get('borrowed_items', []);

        // Periksa apakah item sudah ada dalam daftar pinjaman
        if (isset($borrowedItems[$item->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Item already in borrowing list'
            ], 400);
        }

        // Tambahkan item ke sesi
        $borrowedItems[$item->id] = [
            'id' => $item->id,
            'name' => $item->name,
            'brand' => $item->brand,
            'serial_number' => $item->serial_number
        ];

        session()->put('borrowed_items', $borrowedItems);

        return response()->json([
            'success' => true,
            'message' => 'Item added successfully',
            'item' => $borrowedItems[$item->id]
        ]);
    }

    public function removeItem($itemId)
    {
        $borrowedItems = session()->get('borrowed_items', []);
        
        if (isset($borrowedItems[$itemId])) {
            unset($borrowedItems[$itemId]);
            session()->put('borrowed_items', $borrowedItems);
            
            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Item not found in borrowing list'
        ], 404);
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

}
