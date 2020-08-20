<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(AuthRequest $authRequest)
    {
        if (Auth::attempt($authRequest->only('email', 'password'))) {
            return redirect('/dashboard')->with('success', 'Anda berhasil login');
        }
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'anda sudah logout');
    }
}
