<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == "admin") {
                return redirect()->route('dashboard');
            }
        }
        return back()->with('error', 'Email dan Password tidak cocok');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
