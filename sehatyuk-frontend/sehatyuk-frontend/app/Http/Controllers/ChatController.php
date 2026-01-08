<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.chatbot');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required'
        ]);

        // dd($request->question);
        try {
            $response = Http::post('http://localhost:5000/api/chatbot', [ // arahkan ke Node.js
                'message' => $request->question
            ]);

            // dd($response->body());

            if ($response->successful()) {
                return response()->json([
                    'answer' => $response->json('reply')
                ]);
            } else {
                return response()->json([
                    'answer' => 'Maaf, tidak bisa menjawab saat ini.'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'answer' => 'Terjadi kesalahan saat menghubungi server chatbot.'
            ], 500);
        }
    }
}
