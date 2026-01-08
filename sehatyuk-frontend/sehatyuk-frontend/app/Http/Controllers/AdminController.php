<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $response = Http::get('http://localhost:5000/api/tips');
        $tips = $response->successful() ? $response->json() : [];

        return view('admin.admin', compact('tips'));
    }

    public function addTip(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $response = Http::post('http://localhost:5000/api/tips', $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Artikel berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan artikel');
        }
    }

    public function showTip($id)
    {
        $response = Http::get("http://localhost:5000/api/tips/$id");
        if ($response->successful()) {
            $tip = $response->json();
            return view('admin.tip_show', compact('tip'));
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    public function editTip($id)
    {
        $response = Http::get("http://localhost:5000/api/tips/$id");
        if ($response->successful()) {
            $tip = $response->json();
            return view('admin.tip_edit', compact('tip'));
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    public function updateTip(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $response = Http::put("http://localhost:5000/api/tips/$id", $data);

        if ($response->successful()) {
            return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui artikel');
        }
    }

    public function deleteTip($id)
    {
        $response = Http::delete("http://localhost:5000/api/tips/$id");

        if ($response->successful()) {
            return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus artikel');
        }
    }
}
