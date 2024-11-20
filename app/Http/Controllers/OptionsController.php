<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index()
    {
        if (session()->has('nomor_peminjaman')) {
            session()->forget('nomor_peminjaman');
        }
        return view('user.options');
    }
}
