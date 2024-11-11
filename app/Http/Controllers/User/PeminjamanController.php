<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $borrowedItems = session()->get('borrowed_items', []);
        return view('user.peminjaman.index', compact('borrowedItems'));
    }

    public function scan(Request $request)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|string|max:50',
        ]);
        
        \Log::info("Scanned itemcode:", $validatedData);
        
        // Implement actual logic to retrieve item details from database
        $item = $this->findItemByBarcode($validatedData['barcode']);

        $response = [
            'success' => !!$item,
            'message' => $item ? 'Item added successfully' : 'Item not found',
            'code' => $validatedData,
        ];

        if ($item) {
            // Prepare item data
            $itemData = [
                'uuid' => $item->uuid,
                'name' => $item->nama_barang,
                'brand' => $item->jenis_barang_id,
                'serial_number' => '0001',
                'timestamp' => now()->timestamp // Menambahkan timestamp untuk tracking
            ];

            // Mengambil stack yang ada
            $stack = session()->get('borrowed_items', []);
            
            // Push item baru ke stack (menambahkan ke awal array)
            array_unshift($stack, $itemData);
            
            // Simpan kembali stack ke session
            session()->put('borrowed_items', $stack);
            
            $response['item'] = $itemData;
        }

        return response()->json($response, 200);
    }

    // Method tambahan untuk mengelola stack
    private function popItem()
    {
        $stack = session()->get('borrowed_items', []);
        
        if (!empty($stack)) {
            // Mengambil item teratas (LIFO)
            $poppedItem = array_shift($stack);
            
            // Update session dengan stack yang baru
            session()->put('borrowed_items', $stack);
            
            return response()->json([
                'success' => true,
                'message' => 'Item removed from stack',
                'item' => $poppedItem
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Stack is empty'
        ]);
    }

    private function clearStack()
    {
        session()->forget('borrowed_items');
        
        return response()->json([
            'success' => true,
            'message' => 'Stack cleared successfully'
        ]);
    }

    private function getStack()
    {
        $stack = session()->get('borrowed_items', []);
        
        return response()->json([
            'success' => true,
            'data' => $stack,
            'count' => count($stack)
        ]);
    }
    protected function findItemByBarcode(string $barcode)
    {
        return Barang::where('kode_barang', $barcode)->first(); // Replace with your logic
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
