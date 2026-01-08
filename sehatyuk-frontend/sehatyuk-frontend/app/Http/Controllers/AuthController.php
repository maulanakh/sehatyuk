<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $response = Http::post('http://localhost:5000/api/auth/login', [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        if ($response->successful()) {
            $user = $response->json('user');
            session(['user' => $user]);

            // dd($response->json());

            // Cek role dan arahkan ke halaman sesuai
            if ($user['role'] === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/home');
            }
        } else {
            return back()->with('error', 'Login gagal: ' . $response->json('error'));
        }
    }



    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $response = Http::post('http://localhost:5000/api/auth/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Pendaftaran berhasil']);
        } else {
            return response()->json(['error' => 'Gagal mendaftar: ' . $response->json('error')], 422);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }
}
