<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credential = $request->validate([
            'nim_nidn' => 'numeric|required',
        ]);

        $user = User::where('nim_nidn', $request->nim_nidn)->first();
        
        if ($user) 
        {
            Auth::login($user);
            request()->session()->regenerate();
            return redirect()->intended('dashboard-user');
        } 

        return back()->withErrors([
            'nim_nidn' => 'NIM/NIDN Tidak Terdaftar.',
        ]);

    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login-peminjam');
    }
}
