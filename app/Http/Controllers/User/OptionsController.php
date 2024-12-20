<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        if (session()->has('kodePeminjaman')) {
            session()->forget('kodePeminjaman');
        }
        if (session()->has('kodePengembalian')) {
            session()->forget('kodePengembalian');
        }
        Session()->forget(['dataPeminjaman', 'BarangData']);

        return view('user.options');
    }
}
