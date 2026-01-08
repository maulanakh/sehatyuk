<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class BeritaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:5000/api/tips'); // Pastikan alamat dan port sesuai dengan server Node.js-mu

        if ($response->successful()) {
            $tips = $response->json();
        } else {
            $tips = []; // Jika gagal ambil data
        }

        return view('berita.berita', compact('tips'));
    }
}
