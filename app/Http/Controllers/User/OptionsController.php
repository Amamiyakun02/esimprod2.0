<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
