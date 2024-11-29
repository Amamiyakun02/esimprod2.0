<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index()
    {
        if (session()->has('kodePeminjaman')) {
            session()->forget('kodePeminjaman');
        }
        if (session()->has('kodePengembalian')) {
            session()->forget('kodePengembalian');
        }

        return view('user.options');
    }
}
