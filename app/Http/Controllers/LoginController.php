<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('main', [
            'title' => 'Login',
            'active' => 'login'
        ]);

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim-nidn' => ['required'],
            
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
        

        return back()->withErrors([
            'nim-nidn' => 'The provided credentials do not match our records.',
        ]);
    }
}
